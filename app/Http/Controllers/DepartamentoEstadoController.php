<?php

namespace App\Http\Controllers;

use App\DepartamentoEstado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoEstadoController extends Controller
{
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

        return response()->json([
            "success" => true,
            'estados' => $estados_busqueda
        ], 200);
    }


    public function store(Request $request)
    {
        $departamentoEstado = DepartamentoEstado::create($request->all());

        return response()->json([
            "success" => true
        ], 200);
    }


    public function show(DepartamentoEstado $departamentoEstado)
    {
        $departamento_id = $departamentoEstado->id;

        $estados_busqueda = DB::table('departamento_estados')
            ->select(
                'departamento_estados.*'
            )
            ->where('departamento_estados.id', '=', $departamento_id)
            ->get();

        return response()->json([
            "success" => true,
            "departamento" => $estados_busqueda[0]
        ], 200);
    }


    public function update(Request $request, DepartamentoEstado $departamentoEstado)
    {
        $departamentoEstado->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(DepartamentoEstado $departamentoEstado)
    {
        $departamentoEstado->delete();

        return response()->json(["success" => true], 200);
    }
}
