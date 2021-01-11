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
        return response()->json([
            "success" => true,
            "Tipos" => TipoDocumentoPersona::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $tipoDocumentoPersona = TipoDocumentoPersona::create($request->all());

        return response()->json([
            "success" => true,
            "Tipo" => $tipoDocumentoPersona->id
        ], 200);
    }


    public function show(TipoDocumentoPersona $tipoDocumentoPersona)
    {
        $tipo_id = $tipoDocumentoPersona->id;

        $tipo_busqueda = DB::table('tipo_documento_personas')
            ->select(
                'tipo_documento_personas.*'
            )
            ->where('tipo_documento_personas.id', '=', $tipo_id)
            ->get();

        return response()->json([
            "success" => true,
            "Tipo" => $tipo_busqueda[0]
        ], 200);
    }


    public function update(Request $request, TipoDocumentoPersona $tipoDocumentoPersona)
    {
        $tipoDocumentoPersona->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(TipoDocumentoPersona $tipoDocumentoPersona)
    {
        $tipoDocumentoPersona->delete();

        return response()->json(["success" => true], 200);
    }
}
