<?php

namespace App\Http\Controllers;

use App\MotivoTarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotivoTareaController extends Controller
{
    public function store(Request $request)
    {
        MotivoTarea::create($request->all());
        return response()->json(["success" => true], 200);
    }

    public function show(MotivoTarea $motivoTarea)
    {
        $motivo_busqueda = DB::table('motivo_tareas')
            ->select(
                'estado_tareas.*'
            )
            ->where('motivo_tareas.id', '=', $motivoTarea->id)
            ->get();
        return response()->json([
            "success" => true,
            "estado" => $motivo_busqueda[0]
        ], 200);
    }


    public function update(Request $request, MotivoTarea $motivoTarea)
    {
        $motivoTarea->update($request->all());
        return response()->json(["success" => true], 200);
    }

    public function destroy(MotivoTarea $motivoTarea)
    {
        $estadoTarea->delete();
        return response()->json(["success" => true], 200);
    }
}
