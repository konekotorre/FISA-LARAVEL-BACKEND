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
            ->select(
                'tareas.id',
                'tareas.titulo',
                'visitas.titulo as titulo_visita',
                'tareas.estado',
                'fecha_programada'
            )
            ->where('tareas.visita_id', '=', $visita_id)
            ->orderByDesc('tareas.estado')
            ->orderBy('tareas.titulo')
            ->get();

        return response()->json([
            "success" => true,
            "tareas" => $tareas
        ], 200);
    }

    // public function today(Request $request)
    // {
    //     $now = now();

    //     $tareas = DB::table('tareas')
    //         ->join('visitas', 'visitas.id', '=', 'tareas.visita_id')
    //         ->select(
    //             'tareas.id',
    //             'tareas.titulo',
    //             'visitas.titulo as titulo_visita',
    //             'tareas.estado'
    //         )
    //         ->whereDate('fecha_programada', $now)
    //         ->orderBy('tareas.titulo')
    //         ->get();

    //     return response()->json($tareas);
    // }

    public function store(Request $request)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

        $tarea = Tarea::create($solicitud);

        $tarea_id = $tarea->id;

        $todo_busqueda = DB::table('tareas')
            ->select(
                'visitas.*'
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
            "uisuario_actualizacion" => $editor
        ], 201);
    }


    public function show(Tarea $tarea)
    {
        $tarea_id = $tarea->id;

        $todo_busqueda = DB::table('tareas')
            ->select(
                'visitas.*'
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
            "uisuario_actualizacion" => $editor
        ], 200);
    }


    public function update(Request $request, $tarea)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;

        $tarea->update($solicitud);

        $tarea_id = $tarea->id;

        $todo_busqueda = DB::table('tareas')
            ->select(
                'visitas.*'
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
            "uisuario_actualizacion" => $editor
        ], 200);
    }


    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return response()->json(["success" => true], 204);
    }
}
