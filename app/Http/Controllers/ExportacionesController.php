<?php

namespace App\Http\Controllers;

use App\Exportaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportacionesController extends Controller
{
    public function store(Request $request)
    {
        $key = $request->paises;
        for ($i = 0; $i < count($key); $i++) {
            $detalle['organizacion_id'] = $request->organizacion_id;
            $detalle['pais_id'] = $key[$i];
            Exportaciones::create($detalle);
        }
        return response()->json(["success" => true], 200);
    }
}
