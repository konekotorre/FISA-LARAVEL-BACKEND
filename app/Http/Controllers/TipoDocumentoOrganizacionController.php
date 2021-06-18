<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoDocumentoOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoDocumentoOrganizacionController extends Controller
{
    public function store(Request $request)
    {
        TipoDocumentoOrganizacion::create($request->all());
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(TipoDocumentoOrganizacion $tipoDocumentoOrganizacion)
    {
        $tipo_busqueda = DB::table('tipo_documento_organizacions')
            ->select(
                'tipo_documento_organizacions.*'
            )
            ->where('tipo_documento_organizacions.id', '=', $tipoDocumentoOrganizacion->id)
            ->get();

        return response()->json([
            "success" => true,
            "tipo" => $tipo_busqueda[0]
        ], 200);
    }


    public function update(Request $request, TipoDocumentoOrganizacion $tipoDocumentoOrganizacion)
    {
        $tipoDocumentoOrganizacion->update($request->all());
        return response()->json(["success" => true], 200);
    }


    public function destroy(TipoDocumentoOrganizacion $tipoDocumentoOrganizacion)
    {
        $tipoDocumentoOrganizacion->delete();
        return response()->json(["success" => true], 200);
    }
}
