<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoOficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoOficinaController extends Controller
{

    public function index()
    {
        $tipo_busqueda = DB::table('tipo_oficinas')
            ->select(
                'tipo_oficinas.id',
                'tipo_oficinas.nombre',
                'tipo_oficinas.descripcion'
            )
            ->orderBy('tipo_oficinas.nombre')
            ->get();

        return response()->json($tipo_busqueda);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $tipoOficina = TipoOficina::create($request->all());

        return response()->json($tipoOficina, 201);
    }


    public function show(TipoOficina $tipoOficina)
    {
        $tipo_id = $tipoOficina->id;

        $tipo_busqueda = DB::table('tipo_oficinas')
            ->select(
                'tipo_oficinas.id',
                'tipo_oficinas.nombre',
                'tipo_oficinas.descripcion'
            )
            ->where('tipo_oficinas.id', '=', $tipo_id)
            ->get();

        return response()->json($tipo_busqueda);
    }


    public function update(Request $request, $tipoOficina)
    {
        $tipoOficina->update($request->all());

        return response()->json($tipoOficina, 200);
    }


    public function destroy(TipoOficina $tipoOficina)
    {
        $tipoOficina->delete();

        return response()->json(true, 204);
    }
}
