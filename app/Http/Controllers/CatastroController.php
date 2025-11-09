<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\TCatastro;

class CatastroController extends Controller
{
    public function actForm()
    {
        $fechaHoraActual = Carbon::now();
        return view('form.form', ['fechaActual' => $fechaHoraActual]);
    }
    public function actList_b()
    {
        $registros = TCatastro::all();
        return response()->json(['state' => true,"data"=>$registros]);
    }
    public function actList(Request $request)
    {
        $search = $request->input('search.value');
        $start = $request->input('start');
        $length = $request->input('length');

        $query = TCatastro::query();

        // Si hay búsqueda
        if (!empty($search)) {
            $query->where('nombreEnc', 'like', "%{$search}%")
                ->orWhere('ficha', 'like', "%{$search}%")
                ->orWhere('u4', 'like', "%{$search}%");
        }

        $total = $query->count();

        // $registros = $query->skip($start)->take($length)->get();
        $registros = $query->orderBy('idCat', 'desc') // 👈 aquí
                       ->skip($start)
                       ->take($length)
                       ->get();

        return response()->json([
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $registros
        ]);
    }
    public function actBuscar(Request $r)
    {
        try {
            $cat = TCatastro::where('u4',$r->inscripcion)->first();
            if($cat)
                return response()->json(['state' => true, 'message' => 'El usuario ya fue registrado, estos datos son para actualizar.', 'origen' => 'bd', 'data' => $cat]);
            $inscripcion = trim($r->inscripcion);
            if (empty($inscripcion))
                return response()->json(['state' => false,'message' => 'El número de inscripción es requerido.']);
            $conSql = $this->connectionSql();
            if (!$conSql)
                throw new \Exception('No se pudo establecer conexión con SQL Server.');
            // $query = "SELECT * FROM INSCRIPC WHERE InscriNro = ?";
            $query = "SELECT c.PreMzn,c.PreLote,i.CliNombre,c.Confiax,c.Confidx,c.MedNrox,i.Tarifx,i.InscriNro,c.PreMuni
                FROM INSCRIPC i INNER JOIN CONEXION c ON i.InscriNro = c.InscriNro
                WHERE i.InscriNro = ?";
            $params = [$inscripcion];
            $stmt = sqlsrv_prepare($conSql, $query, $params);
            if (!$stmt)
                throw new \Exception('Error al preparar la consulta: ' . print_r(sqlsrv_errors(), true));
            if (!sqlsrv_execute($stmt))
                throw new \Exception('Error al ejecutar la consulta: ' . print_r(sqlsrv_errors(), true));
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if ($row && isset($row))
                return response()->json(['state' => true,'data' => $row]);
            return response()->json(['state' => false,'message' => 'No se encontraron datos para la inscripción proporcionada.']);
        } catch (\Exception $e) {
            Log::error('Error en actBuscar: ' . $e->getMessage());
            return response()->json(['state' => false,'message' => 'Ocurrió un error al buscar la inscripción.','error' => $e->getMessage()]);
        }
    }

    public function actSaveChanges(Request $r)
    {
        DB::beginTransaction();
        $carpetas = [];
        $imagenesGuardadas = [];
        $imagenesFallidas = [];
        $idCat = $r->idCat;

        try {
            // Actualizar los otros datos (excepto imágenes)
            $data = $r->except(['frontis', 'agua', 'alc', 'ubicacion']);
            DB::table('catastro')->where('idCat', $idCat)->update($data);

            // Lista de campos de imágenes
            foreach (['frontis', 'agua', 'alc', 'ubicacion'] as $campo) {
                if ($r->hasFile($campo))
                {
                    // Si ya existía imagen, elimínala
                    $registro = DB::table('catastro')->where('idCat', $idCat)->first();
                    if ($registro && $registro->$campo) {
                        if (Storage::disk('public')->exists($registro->$campo)) {
                            Storage::disk('public')->delete($registro->$campo);
                        }
                    }

                    // Guardar la nueva
                    $archivo = $r->file($campo);
                    $resultado = $this->guardarImagenCatastro($archivo, $campo, $idCat, $carpetas);

                    if ($resultado['success']) {
                        $imagenesGuardadas[] = $campo;
                    } else {
                        $imagenesFallidas[] = [
                            'campo' => $campo,
                            'error' => $resultado['error']
                        ];
                    }
                }
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'imagenes_guardadas' => $imagenesGuardadas,
                'imagenes_fallidas' => $imagenesFallidas
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function actSave_test(Request $r)
    {
        DB::beginTransaction();
        try {
            // Primero guardamos los datos sin la imagen
            $data = $r->except('frontis');
            $data['frontis'] = null;
            // $catastro = TCatastro::create($data); // aquí ya tenemos el $catastro->id
            // ---
            $idCat = DB::table('catastro')->insertGetId($data);
            $catastro = TCatastro::find($idCat);
            // ---
            // Ahora procesamos la imagen
            if ($r->hasFile('frontis') && is_array($r->frontis))
            {
                $archivo = $r->file('frontis')[0];
                $extension = $archivo->getClientOriginalExtension();
                $nombreArchivo = 'frontis_' . $idCat . '.' . $extension;
                $ruta = $archivo->storeAs('catastro_img/cat_'.$idCat, $nombreArchivo, 'public');
                $catastro->update(['frontis' => $ruta]);
            }
            DB::commit();
            return response()->json(['success' => true, 'id' => $idCat]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
// $resultado = $this->guardarImagenCatastro($archivo, $campo, $idCat, $carpetas=[]);
    private function guardarImagenCatastro($archivo, $nombreCampo, $idCat, &$carpetas)
    {
        try {
            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo = $nombreCampo . '_' . $idCat . '.' . $extension;
            $carpeta = 'catastro_img/cat_' . $idCat;
            $ruta = $archivo->storeAs($carpeta, $nombreArchivo, 'public');
            // Guardar solo si existe la columna
            if (Schema::hasColumn('catastro', $nombreCampo))
            {
                DB::table('catastro')->where('idCat', $idCat)->update([
                    $nombreCampo => $ruta
                ]);
            }
            $carpetas[] = $carpeta;
            return ['success' => true, 'campo' => $nombreCampo, 'ruta' => $ruta];
        } catch (\Exception $e) {
            return ['success' => false, 'campo' => $nombreCampo, 'error' => $e->getMessage()];
        }
    }
    public function actSave(Request $r)
    {
        DB::beginTransaction();
        $carpetas = [];
        $idCat = null;
        $imagenesGuardadas = [];
        $imagenesFallidas = [];

        try {
            $data = $r->except(['frontis', 'agua', 'alc', 'ubicacion', 'idCat']);
            $data['frontis'] = null;
            $data['agua'] = null;
            $data['alc'] = null;
            $data['ubicacion'] = null;
            $data['fechaEnc'] = Carbon::now();
            $idCat = DB::table('catastro')->insertGetId($data);
            if (!$idCat || !is_numeric($idCat))
            {
                throw new \Exception("No se pudo guardar el registro del catastro.");
            }
            foreach (['frontis', 'agua', 'alc', 'ubicacion'] as $campo)
            {
                if ($r->hasFile($campo)) {
                    $archivo = $r->file($campo);
                    // $resultado = $this->guardarImagenCatastro($archivo, $campo, $idCat, $carpetas=[]);
                    $resultado = $this->guardarImagenCatastro($archivo, $campo, $idCat, $carpetas);

                    if ($resultado['success']) {
                        $imagenesGuardadas[] = $campo;
                    } else {
                        $imagenesFallidas[] = [
                            'campo' => $campo,
                            'error' => $resultado['error']
                        ];
                    }
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'idCat' => $idCat,
                'imagenes_guardadas' => $imagenesGuardadas,
                'imagenes_fallidas' => $imagenesFallidas
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            foreach ($carpetas as $carpeta) {
                if ($carpeta && Storage::disk('public')->exists($carpeta)) {
                    Storage::disk('public')->deleteDirectory($carpeta);
                }
            }
            return response()->json([
                'success' => false,
                'error' => 'este: '.$e->getMessage(),
                'imagenes_guardadas' => $imagenesGuardadas,
                'imagenes_fallidas' => $imagenesFallidas
            ], 500);
        }
    }

    public function actSave_last(Request $r)
    {
        DB::beginTransaction();
        $rutaImagen = null;
        $carpeta = null;
        $idCat = null;
        try {
            // Datos sin la imagen
            $data = $r->except('frontis');
            $data['frontis'] = null;
            // Guardar datos y obtener ID
            $idCat = DB::table('catastro')->insertGetId($data);
            if (!$idCat || !is_numeric($idCat))
            {
                throw new \Exception("No se pudo guardar el registro del catastro.");
            }
            // Guardar imagen si existe
            if ($r->hasFile('frontis') && is_array($r->frontis))
            {
                $archivo = $r->file('frontis')[0];
                $extension = $archivo->getClientOriginalExtension();
                $nombreArchivo = 'frontis_' . $idCat . '.' . $extension;
                $carpeta = 'catastro_img/cat_' . $idCat;
                $rutaImagen = $archivo->storeAs($carpeta, $nombreArchivo, 'public');
                DB::table('catastro')->where('idCat', $idCat)->update(['frontis' => $rutaImagen]);
            }
            DB::commit();
            return response()->json(['success' => true, 'idCat' => $idCat]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Eliminar la imagen y la carpeta si existen
            if ($carpeta && Storage::disk('public')->exists($carpeta)) {
                Storage::disk('public')->deleteDirectory($carpeta);
            }
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function actDeleteReg(Request $r)
    {
        // dd($r->all());
        if ($r->password !== '369')
            return response()->json(['success' => false,'message' => 'Contraseña incorrecta. No se puede eliminar el registro.']);
        DB::beginTransaction();
        try {
            $idCat = $r->idCat;
            // Buscar el registro
            $catastro = DB::table('catastro')->where('idCat', $idCat)->first();
            if (!$catastro)
                return response()->json(['success' => false,'message' => 'Registro no encontrado.'], 404);
            // Ruta de la carpeta del registro
            $carpeta = 'catastro_img/cat_' . $idCat;
            // Eliminar la carpeta con todas las imágenes
            if (Storage::disk('public')->exists($carpeta))
                Storage::disk('public')->deleteDirectory($carpeta);
            // Eliminar el registro
            DB::table('catastro')->where('idCat', $idCat)->delete();
            DB::commit();
            return response()->json(['success' => true,'message' => 'Registro e imágenes eliminados correctamente.']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(['success' => false,'error' => $e->getMessage()], 500);
        }
    }

}
