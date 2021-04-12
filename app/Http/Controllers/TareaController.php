<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{

    public function index(Request $request)
    {
        $visita_id = $request->input('visita_id');

        $tareas = DB::table('tareas')
        ->join('estado_tareas', 'estado_tareas.id', '=', 'tareas.estado_id')
            ->select(
                'tareas.id',
                'tareas.visita_id',
                'tareas.titulo',
                'tareas.descripcion',
                'tareas.resultado',
                'estado_tareas.nombre',
            )
            ->where('tareas.visita_id', '=', $visita_id)
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
        $creador = $creador_auth['id'];

        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

        $tarea = Tarea::create($solicitud);

        $tarea_id = $tarea->id;

        return response()->json([
            "success" => true,
            "tarea" => $tarea_id
        ], 200);
    }


    public function show(Tarea $tarea)
    {
        $tarea_id = $tarea->id;

        $todo_busqueda = DB::table('tareas')
            ->select(
                'tareas.*'
            )
            ->where('tareas.id', '=', $tarea_id)
            ->get();

        $todo = $todo_busqueda[0];

        $creador_busqueda = DB::table('tareas')
            ->join('users', 'users.id', '=', 'tareas.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('tareas.id', '=', $tarea_id)
            ->get();

        $creador = $creador_busqueda[0];

        $editor_busqueda = DB::table('tareas')
            ->join('users', 'users.id', '=', 'tareas.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('tareas.id', '=', $tarea_id)
            ->get();

        $editor = $editor_busqueda[0];

        return response()->json([
            "success" => true,
            "tarea" => $todo,
            "usuario_creacion" => $creador,
            "usuario_actualizacion" => $editor
        ], 200);
    }


    public function update(Request $request, Tarea $tarea)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;

        $tarea->update($solicitud);

        $tarea_id = $tarea->id;

        return response()->json([
            "success" => true,
            "tarea" => $tarea_id
        ], 200);
    }


    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json(["success" => true], 200);
    }
}
