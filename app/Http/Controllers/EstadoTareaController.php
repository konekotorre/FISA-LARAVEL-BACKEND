<?php

namespace App\Http\Controllers;

use App\EstadoTarea;
use Illuminate\Http\Request;

class EstadoTareaController extends Controller
{
    public function index()
    {
        return response()->json([
            "success" => true,
            "estados" => EstadoTarea::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $estadoTarea = EstadoTarea::create($request->all());

        return response()->json(["success" => true], 200);
    }

    public function show(EstadoTarea $estadoTarea)
    {
        $estado_id = $estadoTarea->id;

        $estado_busqueda = DB::table('estado_tareas')
            ->select(
                '*'
            )
            ->where('estado_tareas.id', '=', $estado_id)
            ->get();

        return response()->json([
            "success" => true,
            "estado" => $estado_busqueda[0]
        ], 200);
    }


    public function update(Request $request, EstadoTarea $estadoTarea)
    {
        $estadoTarea->update($request->all());

        return response()->json(["success" => true], 200);
    }

    public function destroy(EstadoTarea $estadoTarea)
    {
        $estadoTarea->delete();

        return response()->json(["success" => true], 200);
    }
}
