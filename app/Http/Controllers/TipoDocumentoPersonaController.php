<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoDocumentoPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoDocumentoPersonaController extends Controller
{

    public function index()
    {
        $tipo_busqueda = DB::table('tipo_documento_personas')
            ->select(
                'tipo_documento_personas.id',
                'tipo_documento_personas.nombre',
                'tipo_documento_personas.descripcion'
            )
            ->orderBy('tipo_documento_personas.nombre')
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


        $tipoDocumentoPersona = TipoDocumentoPersona::create($request->all());

        return response()->json($tipoDocumentoPersona, 201);
    }


    public function show(TipoDocumentoPersona $tipoDocumentoPersona)
    {
        $tipo_id = $tipoDocumentoPersona->id;

        $tipo_busqueda = DB::table('tipo_documento_personas')
            ->select(
                'tipo_documento_personas.id',
                'tipo_documento_personas.nombre',
                'tipo_documento_personas.descripcion'
            )
            ->where('tipo_documento_personas.id', '=', $tipo_id)
            ->get();

        return response()->json($tipo_busqueda);
    }


    public function update(Request $request, $tipoDocumentoPersona)
    {
        $tipoDocumentoPersona->update($request->all());

        return response()->json($tipoDocumentoPersona, 200);
    }


    public function destroy(TipoDocumentoPersona $tipoDocumentoPersona)
    {
        $tipoDocumentoPersona->delete();

        return response()->json(true, 204);
    }
}
