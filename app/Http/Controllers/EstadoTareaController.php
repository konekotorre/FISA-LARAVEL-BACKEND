<?php

namespace App\Http\Controllers;

use App\EstadoTarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadoTareaController extends Controller
{
    public function store(Request $request)
    {
        EstadoTarea::create($request->all());
        return response()->json(["success" => true], 200);
    }

    public function show(EstadoTarea $estadoTarea)
    {
        $estado_busqueda = DB::table('estado_tareas')
            ->select(
                'estado_tareas.*'
            )
            ->where('estado_tareas.id', '=', $estadoTarea->id)
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
