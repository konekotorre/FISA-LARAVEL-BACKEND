<?php

namespace App\Http\Controllers;

use App\Importaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportacionesController extends Controller
{
    public function store(Request $request)
    {
        $key = $request->paises;
        for ($i = 0; $i < count($key); $i++) {
            $detalle['organizacion_id'] = $equest->organizacion_id;
            $detalle['pais_id'] = $key[$i];
            Importaciones::create($detalle);
        }
        return response()->json(["success" => true], 200);
    }

}
