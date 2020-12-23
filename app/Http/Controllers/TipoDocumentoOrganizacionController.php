<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoDocumentoOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoDocumentoOrganizacionController extends Controller
{

    public function index()
    {
        $tipo_busqueda = DB::table('tipo_documento_organizacions')
            ->select(
                'tipo_documento_organizacions.id',
                'tipo_documento_organizacions.nombre',
                'tipo_documento_organizacions.descripcion'
            )
            ->orderBy('tipo_documento_organizacions.nombre')
            ->get();

        return response()->json($tipo_busqueda);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $tipoDocumentoOrganizacion = TipoDocumentoOrganizacion::create($request->all());

        return response()->json($tipoDocumentoOrganizacion, 201);
    }


    public function show(TipoDocumentoOrganizacion $tipoDocumentoOrganizacion)
    {
        $tipoDoc_id = $tipoDocumentoOrganizacion->id;

        $tipo_busqueda = DB::table('tipo_documento_organizacions')
            ->select(
                'tipo_documento_organizacions.id',
                'tipo_documento_organizacions.nombre',
                'tipo_documento_organizacions.descripcion'
            )
            ->where('tipo_documento_organizacions.id', '=', $tipoDoc_id)
            ->get();

        return response()->json($tipo_busqueda);
    }


    public function update(Request $request, $tipoDocumentoOrganizacion)
    {
        $tipoDocumentoOrganizacion->update($request->all());

        return response()->json($tipoDocumentoOrganizacion, 200);
    }


    public function destroy(TipoDocumentoOrganizacion $tipoDocumentoOrganizacion)
    {
        $tipoDocumentoOrganizacion->delete();

        return response()->json(true, 204);
    }
}
