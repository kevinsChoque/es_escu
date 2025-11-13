<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapaController extends Controller
{
    public function index()
    {
        $data = DB::table('catastros')
            ->select('manzana', DB::raw('COUNT(*) as total'))
            ->where('situacion_conexion', 'ACTIVO')
            ->groupBy('manzana')
            ->get();

        return view('mapa.index', compact('data'));
    }
}
