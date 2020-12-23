<?php

namespace App\Http\Controllers;

use App\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaseController extends Controller
{

    public function index()
    {
        $clase_busqueda = DB::table('clases')
            ->select(
                'clases.id',
                'clases.nombre',
                'clases.descripcion',
            )
            ->get();

        return response()->json($clase_busqueda);
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


        $clase = Clase::create($request->all());

        return response()->json($clase, 201);
    }


    public function show(Clase $clase)
    {
        $clase_id = $clase->id;

        $clase_busqueda = DB::table('clases')
            ->select(
                'clases.id',
                'clases.nombre',
                'clases.descripcion',
            )
            ->where('clases.id', '=', $clase_id)
            ->get();

        return response()->json($clase_busqueda);
    }


    public function update(Request $request, $clase)
    {
        $clase->update($request->all());

        return response()->json($clase, 200);
    }


    public function destroy(Clase $clase)
    {
        $clase->delete();

        return response()->json(true, 204);
    }
}
