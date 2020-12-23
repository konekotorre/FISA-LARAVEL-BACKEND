<?php

namespace App\Http\Controllers;

use App\DepartamentoEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoEstadoController extends Controller
{

    public function index()
    {
        $estados_busqueda = DB::table('departamento_estados')
            ->join('pais', 'pais.id', '=', 'departamento_estados.pais_id')
            ->select(
                'departamento_estados.id',
                'departamento_estados.nombre',
                'pais.nombre as pais'
            )
            ->orderBy('pais.nombre')
            ->get();

        return response()->json(['estados' => $estados_busqueda], 200);
    }


    public function indexByPais(Request $request)
    {
        $pais_id = $request->input('pais_id');

        $estados_busqueda = DB::table('departamento_estados')
            ->select(
                'departamento_estados.id',
                'departamento_estados.nombre',
            )
            ->where('departamento_estados.pais_id', '=', $pais_id)
            ->orderBy('nombre')
            ->get();

            return response()->json(['estados' => $estados_busqueda], 200);
    }


    public function search(Request $request)
    {
        $palabra = $request->input('palabra');
        $nombre = '%' . $palabra . '%';

        $estados_busqueda = DB::table('departamento_estados')
            ->join('pais', 'pais.id', '=', 'departamento_estados.pais_id')
            ->select(
                'departamento_estados.id',
                'departamento_estados.nombre as departamento_estado',
                'pais.nombre as pais'
            )
            ->where('departamento_estados.nombre', 'ilike', $nombre)
            ->get();

        return response()->json($estados_busqueda, 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'pais_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $departamentoEstado = DepartamentoEstado::create($request->all());

        return response()->json($departamentoEstado, 201);
    }


    public function show(DepartamentoEstado $departamentoEstado)
    {
        $departamento_id = $departamentoEstado->id;

        $estados_busqueda = DB::table('departamento_estados')
            ->join('pais', 'pais.id', '=', 'departamento_estados.pais_id')
            ->select(
                'departamento_estados.id',
                'departamento_estados.nombre',
                'pais.nombre as pais'
            )
            ->where('departamento_estados.id', '=', $departamento_id)
            ->get();

        return response()->json($estados_busqueda, 200);
    }


    public function update(Request $request, DepartamentoEstado $departamentoEstado)
    {
        $departamentoEstado->update($request->all());

        return response()->json($departamentoEstado, 200);
    }


    public function destroy(DepartamentoEstado $departamentoEstado)
    {
        $departamentoEstado->delete();

        return response()->json(true, 204);
    }
}
