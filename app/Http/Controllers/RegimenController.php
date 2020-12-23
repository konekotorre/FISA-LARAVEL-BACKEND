<?php

namespace App\Http\Controllers;

use Validator;
use App\Regimen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegimenController extends Controller
{

    public function index()
    {
        $regimen_busqueda = DB::table('regimens')
            ->select(
                'regimens.id',
                'regimens.nombre',
                'regimens.descripcion'
            )
            ->orderBy('regimens.nombre')
            ->get();

        return response()->json($regimen_busqueda);
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

        $regimen = Regimen::create($request->all());

        return response()->json($regimen, 201);
    }


    public function show(Regimen $regimen)
    {
        $regimen_id = $regimen->id;

        $regimen_busqueda = DB::table('regimens')
            ->select(
                'regimens.id',
                'regimens.nombre',
                'regimens.descripcion'
            )
            ->where('regimens.id', '=', $regimen_id)
            ->get();

        return response()->json($regimen_busqueda);
    }


    public function update(Request $request, Regimen $regimen)
    {
        $regimen->update($request->all());

        return response()->json($regimen, 200);
    }


    public function destroy(Regimen $regimen)
    {
        $regimen->delete();

        return response()->json(true, 204);
    }
}
