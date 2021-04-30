<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoOrganizacionController extends Controller
{
    public function store(Request $request)
    {
        TipoOrganizacion::create($request->all());

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(TipoOrganizacion $tipoOrganizacion)
    {
        $tipo_id = $tipoOrganizacion->id;

        $tipo_busqueda = DB::table('tipo_organizacions')
            ->select(
                'tipo_organizacions.*'
            )
            ->where('tipo_organizacions.id', '=', $tipo_id)
            ->get();

        return response()->json([
            "success" => true,
            "tipo" => $tipo_busqueda[0]
        ], 200);
    }


    public function update(Request $request, TipoOrganizacion $tipoOrganizacion)
    {
        $tipoOrganizacion->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(TipoOrganizacion $tipoOrganizacion)
    {
        $tipoOrganizacion->delete();

        return response()->json(["success" => true], 200);
    }
}
