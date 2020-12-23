<?php

namespace App\Http\Controllers;

use App\Exportaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportacionesController extends Controller
{
    public function store(Request $request)
    {
        $org_id = $request->organizacion_id;

        $key = $request->paises;
        $count = count($key);

        for ($i = 0; $i < $count; $i++) {
            $detalle['organizacion_id'] = $org_id;
            $detalle['pais_id'] = $key[$i];

            Exportaciones::create($detalle);
        }
        return response()->json(["success" => true], 200);
    }
}
