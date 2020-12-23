<?php

namespace App\Http\Controllers;

use Validator;
use App\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{

    public function index()
    {
        $pais_busqueda = DB::table('pais')
            ->select(
                'pais.id',
                'pais.nombre',
            )
            ->orderBy('pais.nombre')
            ->get();

        return response()->json($pais_busqueda);
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

        $pais = Pais::create($request->all());

        return response()->json($pais, 201);
    }


    public function show(Pais $pais)
    {
        $pais_id = $pais->id;

        $pais_busqueda = DB::table('pais')
            ->select(
                'pais.id',
                'pais.nombre',
            )
            ->where('pais.id', '=', $pais_id)
            ->get();

        return response()->json($pais_busqueda);
    }


    public function update(Request $request, Pais $pais)
    {
        $pais->update($request->all());

        return response()->json($pais, 200);
    }


    public function destroy(Pais $pais)
    {
        $pais->delete();

        return response()->json(true, 204);
    }
}
