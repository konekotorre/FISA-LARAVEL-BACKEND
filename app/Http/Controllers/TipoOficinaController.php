<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoOficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoOficinaController extends Controller
{
    public function store(Request $request)
    {
        TipoOficina::create($request->all());

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(TipoOficina $tipoOficina)
    {
        $tipo_id = $tipoOficina->id;

        $tipo_busqueda = DB::table('tipo_oficinas')
            ->select(
                'tipo_oficinas.*'
            )
            ->where('tipo_oficinas.id', '=', $tipo_id)
            ->get();

        return response()->json([
            "success" => true,
            "tipo" => $tipo_busqueda[0]
        ], 200);
    }


    public function update(Request $request, TipoOficina $tipoOficina)
    {
        $tipoOficina->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(TipoOficina $tipoOficina)
    {
        $tipoOficina->delete();

        return response()->json(["success" => true], 200);
    }
}
