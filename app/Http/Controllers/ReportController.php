<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function actShow()
    {
        $data = DB::table('catastro')
            ->select('u5', DB::raw('COUNT(*) as total'))
            ->where('u2', 'ACTIVO')
            ->groupBy('u5')
            ->get();

        // Simulación de datos que normalmente vendrían de la BD
        $data = collect([
            ['manzana' => 'A', 'total' => 15, 'latitud' => -13.6371, 'longitud' => -72.8819],
            ['manzana' => 'B', 'total' => 25, 'latitud' => -13.6365, 'longitud' => -72.8795],
            ['manzana' => 'C', 'total' => 10, 'latitud' => -13.6380, 'longitud' => -72.8830],
            ['manzana' => 'D', 'total' => 5,  'latitud' => -13.6390, 'longitud' => -72.8805],
            ['manzana' => 'E', 'total' => 18, 'latitud' => -13.6400, 'longitud' => -72.8820],
        ]);

        return view('report.show', compact('data'));
        // return view('report.show');
    }
    public function resumen()
    {
        // Aquí puedes usar tus tablas reales, esto es solo un ejemplo:
        $data = [
            'registradas' => DB::table('catastro')->count(),
            'observadas' => DB::table('catastroo')->count(),
            'tarifa_domestica_17' => DB::table('catastro')->where('ci1', '17-DOMESTICO')->count(),
            'tarifa_domestica_18' => DB::table('catastro')->where('ci1', '18-DOMESTICO')->count(),
            'tarifa_comercial' => DB::table('catastro')->where('ci1', '25-COMERCIAL')->count(),
            'tarifa_industrial' => DB::table('catastro')->where('ci1', '43-INDUSTRIAL')->count(),
            'tarifa_estatal' => DB::table('catastro')->where('ci1', '64-ESTATAL')->count(),
            'tarifa_social' => DB::table('catastro')->where('ci1', '1-SOCIAL')->count(),
        ];
        return response()->json($data);
    }
    public function d1()
    {
        try {
            $encuestadores = DB::table('catastro')
                ->select('nombreEnc', DB::raw('COUNT(idCat) as total'))
                ->whereNotNull('nombreEnc')
                ->where('nombreEnc', '!=', '')
                ->where('nombreEnc', '!=', 'Seleccione...')
                ->groupBy('nombreEnc')
                ->orderByDesc('total')
                ->get();
            // Si no hay resultados
            if ($encuestadores->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'labels' => ['Sin datos'],
                        'datasets' => [[
                            'data' => [1],
                            'backgroundColor' => ['#e9ecef'],
                            'borderColor' => '#ffffff',
                            'borderWidth' => 2
                        ]]
                    ],
                    'total_encuestas' => 0,
                    'message' => 'No hay registros disponibles'
                ]);
            }
            // Preparar datos para Chart.js
            $labels = $encuestadores->pluck('nombreEnc')->toArray();
            $data = $encuestadores->pluck('total')->toArray();
            $colores = $this->generarColores(count($labels));
            return response()->json([
                'success' => true,
                'data' => [
                    'labels' => $labels,
                    'datasets' => [[
                        'data' => $data,
                        'backgroundColor' => $colores,
                        'borderColor' => '#ffffff',
                        'borderWidth' => 2
                    ]]
                ],
                'total_encuestas' => array_sum($data)
            ]);
        } catch (\Throwable $e) {
            \Log::error('Error en d1(): ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar los datos de encuestadores.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Genera colores aleatorios o usa una paleta base
     */
    private function generarColores($cantidad)
    {
        $base = [
            '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8',
            '#6610f2', '#20c997', '#6f42c1', '#fd7e14', '#343a40'
        ];
        if ($cantidad <= count($base))
            return array_slice($base, 0, $cantidad);
        // Si faltan colores, generar más aleatoriamente
        while (count($base) < $cantidad) {
            $base[] = sprintf("#%06x", mt_rand(0, 0xFFFFFF));
        }
        return $base;
    }
    public function bar1(Request $r)
    {
        // Si hay filtro manual, se usa
        if ($r->inicio && $r->fin) {
            $inicio = Carbon::parse($r->inicio);
            $fin = Carbon::parse($r->fin);
            $data = DB::table('catastro')
                ->select(
                    DB::raw('DATE(fechaEnc) as fecha'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereBetween('fechaEnc', [$inicio->startOfDay(), $fin->endOfDay()])
                ->groupBy('fecha')
                ->orderBy('fecha', 'asc')
                ->get();
        }
        else {
            // Si no hay filtro → traer las 30 fechas más recientes donde hubo registros
            $data = DB::table('catastro')
                ->select(
                    DB::raw('DATE(fechaEnc) as fecha'),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('fecha')
                ->orderBy('fecha', 'desc')
                ->limit(30)
                ->get()
                ->sortBy('fecha') // reordenar ascendente para el gráfico
                ->values();
        }
        return response()->json($data);
    }
    public function barapi1_eli(Request $request)
    {
        $tipoConstruccion = $request->input('tipo_construccion');
        if (!empty($tipoConstruccion)) {
            // Caso: se envía tipo de construcción
            $resultados = DB::table('catastro')
                ->select('d11', DB::raw('COUNT(idCat) as total'))
                ->where('d10', $tipoConstruccion)
                ->groupBy('d11')
                ->get();
        } else {
            // Caso: no se envía tipo de construcción
            $resultados = DB::table('catastro')
                ->select('d11', DB::raw('COUNT(idCat) as total'))
                ->groupBy('d11')
                ->get();
        }
        return response()->json([
            'success' => true,
            'data' => $resultados
        ]);
    }
    // public function barapi1(Request $request)
    // {
    //     $tipoConstruccion = $request->input('tipo_construccion');

    //     if (!empty($tipoConstruccion)) {
    //         // Caso: se envía tipo de construcción
    //         $resultados = DB::table('catastro')
    //             ->select(DB::raw("COALESCE(d11, 'EN_BLANCO') as d11"), DB::raw('COUNT(idCat) as total'))
    //             ->where('d10', $tipoConstruccion)
    //             ->groupBy(DB::raw("COALESCE(d11, 'EN_BLANCO')"))
    //             ->get();
    //     } else {
    //         // Caso: no se envía tipo de construcción
    //         $resultados = DB::table('catastro')
    //             ->select(DB::raw("COALESCE(d11, 'EN_BLANCO') as d11"), DB::raw('COUNT(idCat) as total'))
    //             ->groupBy(DB::raw("COALESCE(d11, 'EN_BLANCO')"))
    //             ->get();
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data' => $resultados
    //     ]);
    // }
    public function barapi1(Request $request)
    {
        $tipoConstruccion = $request->input('tipo_construccion');

        $baseQuery = DB::table('catastro');

        if (!empty($tipoConstruccion)) {
            $baseQuery->where('d10', $tipoConstruccion);
        }

        // Conteo por tipo de servicio (d11)
        $servicios = (clone $baseQuery)
            ->select(DB::raw("COALESCE(d11, 'EN_BLANCO') as categoria"), DB::raw('COUNT(idCat) as total'))
            ->groupBy(DB::raw("COALESCE(d11, 'EN_BLANCO')"))
            ->get();

        // Conteo por tipo de almacenamiento (d12)
        $almacenamiento = (clone $baseQuery)
            ->select(DB::raw("COALESCE(d12, 'EN_BLANCO') as categoria"), DB::raw('COUNT(idCat) as total'))
            ->groupBy(DB::raw("COALESCE(d12, 'EN_BLANCO')"))
            ->get();

        return response()->json([
            'success' => true,
            'servicio' => $servicios,
            'almacenamiento' => $almacenamiento
        ]);
    }

}
