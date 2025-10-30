<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class Cf2Controller extends Controller
{
    public function actForm2(Request $r)
    {
        return view('form.form2');
        // return view('form.form', ['fechaActual' => $fechaHoraActual]);
    }
    public function actShowInfo(Request $r)
    {
        $catastro = DB::table('catastroo')->where('ins', $r->ins)->first();

        $conSql = $this->connectionSql();
        $params = [$r->get('ins')];
        $query = "
            SELECT
                c.PreMzn,
                c.PreLote,
                c.InscriNro,
                c.Clinomx,
                i.Tarifx,
                ca.ConEstado,
                rz.CalTip,
                rz.CalDes,
                rl.UrbTip,
                rl.UrbDes,
                (ISNULL(rz.CalTip, '') + ' ' + ISNULL(rz.CalDes, '') +
                ' - ' + ISNULL(rl.UrbTip, '') + ' ' + ISNULL(rl.UrbDes, '')) AS direccion,
                LTRIM(RTRIM(c.MedNror)) AS MedNror,
                cd.ConDEstad
            FROM CONEXION c
            INNER JOIN INSCRIPC i ON c.InscriNro = i.InscriNro
            INNER JOIN COAGUA ca ON c.PreMzn = ca.PreMzn AND c.PreLote = ca.PreLote
            INNER JOIN CODESA cd ON c.PreMzn = cd.PreMzn AND c.PreLote = cd.PreLote
            INNER JOIN rzcalle rz ON c.precalle = rz.calcod
            INNER JOIN rlurba rl ON c.preurba = rl.urbcod
            WHERE c.InscriNro = ?";
        $stmt = sqlsrv_prepare($conSql, $query, $params);
        if (!$stmt)
            return response()->json(['error' => sqlsrv_errors()], 500);
        if (!sqlsrv_execute($stmt))
            return response()->json(['error' => sqlsrv_errors()], 500);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        // return response()->json($row);
        $imagenes = [];
        $ruta = $catastro->frontis ?? null;
        if (!empty($ruta) && Storage::disk('public')->exists($ruta)) {
            $archivos = Storage::disk('public')->files($ruta);

            foreach ($archivos as $archivo) {
                if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $archivo)) {
                    $imagenes[] = asset('storage/' . $archivo);
                }
            }
        }
        return response()->json([
            'success' => true,
            'data' => $row,
            'catastroObs' => $catastro, // 👈 aquí va el registro completo o null
            'origen' => $catastro?'update':null,
            'imagenes' => $imagenes
        ]);
    }
    public function actSave(Request $r)
    {
        // dd($r->all());
        DB::beginTransaction();
        $carpetas = [];
        $imagenesGuardadas = [];
        $imagenesFallidas = [];
        try {
            if (DB::table('catastroo')->where('ins', $r->ins)->exists())
                throw new \Exception("Ya existe un registro en OBS con el código de INS: {$r->ins}");
            // 1️⃣ Crear el registro base en 'catastro'
            $data = $r->except(['frontis']);
            $data = $r->except(['idCao']);
            $data['frontis'] = null; // se actualizará luego con la ruta de la carpeta
            $data['fechaEnc'] = Carbon::now();
            $idCao = DB::table('catastroo')->insertGetId($data);
            if (!$idCao || !is_numeric($idCao))
                throw new \Exception("No se pudo guardar el registro del catastro.");
            // 2️⃣ Validar y procesar imágenes solo si existe 'frontis'
            if ($r->hasFile('frontis')) {
                $imagenes = $r->file('frontis');
                // Aseguramos que $imagenes sea siempre un array
                if (!is_array($imagenes)) {
                    $imagenes = [$imagenes];
                }
                // Validar cantidad de imágenes
                if (count($imagenes) > 6)
                    throw new \Exception("Solo se permiten subir máximo 6 imágenes en 'frontis'.");
                $carpeta = "catastro_obs/{$idCao}_{$r->ins}";
                // Crear carpeta si no existe
                Storage::disk('public')->makeDirectory($carpeta);
                // Guardar imágenes
                $contador = 1;
                foreach ($imagenes as $img) {
                    try {
                        // Nombre correlativo: 1.jpg, 2.jpg, 3.png, etc.
                        $extension = $img->getClientOriginalExtension();
                        $nombreArchivo = $contador . '.' . $extension;
                        $ruta = $img->storeAs($carpeta, $nombreArchivo, 'public');
                        $imagenesGuardadas[] = $ruta;
                        $contador++;
                    } catch (\Exception $ex) {
                        $imagenesFallidas[] = [
                            'nombre' => $img->getClientOriginalName(),
                            'error' => $ex->getMessage()
                        ];
                    }
                }
                // 3️⃣ Guardar la ruta de la carpeta en la BD
                DB::table('catastroo')
                    ->where('idCao', $idCao)
                    ->update(['frontis' => $carpeta]);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'idCao' => $idCao,
                'ruta_carpeta' => $carpeta ?? null,
                'imagenes_guardadas' => $imagenesGuardadas,
                'imagenes_fallidas' => $imagenesFallidas
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Eliminar carpetas creadas si hay error
            // if ($carpeta && Storage::disk('public')->exists($carpeta))
            //     Storage::disk('public')->deleteDirectory($carpeta);
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'imagenes_guardadas' => $imagenesGuardadas,
                'imagenes_fallidas' => $imagenesFallidas
            ], 500);
        }
    }
    public function actSaveChanges(Request $r)
    {
        DB::beginTransaction();
        try {
            $idCao = $r->idCao; // id del registro a actualizar
            $registro = DB::table('catastroo')->where('idCao', $idCao)->first();

            if (!$registro) {
                throw new \Exception("No se encontró el registro.");
            }

            // =====================================================
            // 1️⃣ ACTUALIZAR CAMPOS NORMALES
            // =====================================================
            DB::table('catastroo')->where('idCao', $idCao)->update([
                'nombreEnc' => $r->nombreEnc,
                'obs' => $r->obs,
            ]);

            // =====================================================
            // 2️⃣ SI SE ENVIARON NUEVAS IMÁGENES
            // =====================================================
            if ($r->hasFile('frontis')) {

                // Eliminar carpeta anterior (si existe)
                if (!empty($registro->frontis) && Storage::disk('public')->exists($registro->frontis)) {
                    Storage::disk('public')->deleteDirectory($registro->frontis);
                }

                // Crear carpeta nueva (por ejemplo: catastro_obs/{id})
                $ruta = "catastro_obs/{$idCao}_{$r->ins}";
                Storage::disk('public')->makeDirectory($ruta);

                // Guardar nuevas imágenes
                foreach ($r->file('frontis') as $index => $imagen) {
                    $nombre = ($index + 1) . '.' . $imagen->getClientOriginalExtension();
                    $imagen->storeAs($ruta, $nombre, 'public');
                }

                // Guardar la ruta en la base de datos
                DB::table('catastroo')->where('idCao', $idCao)->update([
                    'frontis' => $ruta
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Actualización exitosa.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
