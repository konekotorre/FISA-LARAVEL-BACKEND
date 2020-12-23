<?php

namespace App\Http\Controllers;

use Validator;
use App\DetalleActividadEconomica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleActividadEconomicaController extends Controller
{
    public function store(Request $request)
    {

        $org_id = $request->organizacion_id;

        $key = $request->actividades;
        $count = count($key);

        for ($i = 0; $i < $count; $i++) {
            $detalle['organizacion_id'] = $org_id;
            $detalle['ciiu_id'] = $key[$i];

            DetalleActividadEconomica::create($detalle);
        }
        return response()->json(["success" => true], 200);
    }

}
