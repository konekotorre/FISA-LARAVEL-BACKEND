<?php

namespace App\Http\Controllers;

use App\MotivoTarea;
use App\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{

    public function index(Request $request)
    {
        $tareas = DB::table('tareas')
        ->leftJoin('estado_tareas', 'estado_tareas.id', '=', 'tareas.estado_id')
        ->leftJoin('motivo_tareas', 'motivo_tareas.id', '=', 'tareas.motivo_id')
            ->select(
                'tareas.id',
                'tareas.visita_id',
                'tareas.titulo',
                'tareas.descripcion',
                'tareas.resultado',
                'estado_tareas.nombre as estado',
                'motivo_tareas.nombre as motivo'
            )
            ->where('tareas.visita_id', '=', $request->visita_id)
            ->orderByDesc('tareas.updated_at')
            ->get();
        return response()->json([
            "success" => true,
            "tareas" => $tareas
        ], 200);
    }

    public function store(Request $request)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_creacion'] = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $tarea = Tarea::create($solicitud);
        return response()->json([
            "success" => true,
            "tarea" => $tarea->id
        ], 200);
    }


    public function show(Tarea $tarea)
    {
        $todo_busqueda = DB::table('tareas')
            ->select(
                'tareas.*'
            )
            ->where('tareas.id', '=', $tarea->id)
            ->get();
        $creador_busqueda = DB::table('tareas')
            ->join('users', 'users.id', '=', 'tareas.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('tareas.id', '=', $tarea->id)
            ->get();
        $editor_busqueda = DB::table('tareas')
            ->join('users', 'users.id', '=', 'tareas.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('tareas.id', '=', $tarea->id)
            ->get();
        return response()->json([
            "success" => true,
            "tarea" => $todo_busqueda[0],
            "usuario_creacion" => $creador_busqueda[0],
            "usuario_actualizacion" => $editor_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Tarea $tarea)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $tarea->update($solicitud);
        return response()->json([
            "success" => true,
            "tarea" => $tarea->id
        ], 200);
    }


    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return response()->json(["success" => true], 200);
    }
}
