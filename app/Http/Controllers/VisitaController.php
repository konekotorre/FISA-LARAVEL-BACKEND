<?php

namespace App\Http\Controllers;

use App\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisitaController extends Controller
{

    public function index()
    {
        $visitas = DB::table('visitas')
            ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
            ->select(
                'visitas.id',
                'organizacions.nombre as organizacion',
                'visitas.fecha_programada',
                'visitas.titulo',
                'visitas.estado'
            )
            ->orderByDesc('estado')
            ->orderBy('fecha_programada')
            ->orderBy('titulo')
            ->get();

        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ]);
    }


    public function indexByOrganizacion(Request $request)
    {
        $organizacion_id = $request->organizacion_id;

        $visitas = DB::table('visitas')
            ->select(
                'visitas.id',
                'visitas.fecha_programada',
                'visitas.titulo',
                'visitas.estado'
            )
            ->where('visitas.organizacion_id', '=', $organizacion_id)
            ->orderByDesc('estado')
            ->orderBy('fecha_programada')
            ->orderBy('titulo')
            ->get();

        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }

    public function today()
    {
        $now = now();

        $visitas = DB::table('visitas')
            ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
            ->select(
                'visitas.id',
                'visitas.titulo',
                'visitas.estado',
                'organizacion.nombre as organizacion'
            )
            ->whereDate('fecha_programada', '=', $now)
            ->orderBy('titulo')
            ->get();

        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }

    public function search(Request $request)
    {
        $solicitud = $request->all();

        $tipo = $solicitud['tipo'];
        $palabra = $solicitud['palabra'];

        if ($tipo = "fecha_programada") {
            $busqueda = DB::table('visitas')
                ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
                ->select(
                    'visitas.id',
                    'organizacions.nombre as organizacion',
                    'visitas.fecha_programada',
                    'visitas.titulo',
                    'visitas.estado'
                )->where('fecha', '=', $palabra)
                ->orderByDesc('estado')
                ->orderBy('fecha_programada')
                ->get();
        } elseif ($tipo == "titulo") {
            $palabra_final = '%' . $palabra . '%';

            $busqueda = DB::table('visitas')
                ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
                ->select(
                    'visitas.id',
                    'organizacions.nombre as organizacion',
                    'visitas.fecha_programada',
                    'visitas.titulo',
                    'visitas.estado'
                )->where('titulo', 'ilike', $palabra_final)
                ->orderByDesc('estado')
                ->orderBy('fecha_programada')
                ->get();
        } elseif ($tipo == "organizacion") {
            $palabra_final = '%' . $palabra . '%';

            $busqueda = DB::table('visitas')
                ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
                ->select(
                    'visitas.id',
                    'organizacions.nombre as organizacion',
                    'visitas.fecha_programada',
                    'visitas.titulo',
                    'visitas.estado'
                )->where('organizacion.nombre', 'ilike', $palabra_final)
                ->orderByDesc('estado')
                ->orderBy('fecha_programada')
                ->get();
        } else {
            return response()->json(["success" => false], 404);
        }
        return response()->json([
            "success" => true,
            "visitas" => $busqueda
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $fecha_validate = $solicitud['fecha_programada'];
        $organizacion_validate = $solicitud['organizacion_id'];
        $oficina_validate = $solicitud['oficina_id'];

        $validate = DB::table('visitas')
            ->select('fecha_programada')
            ->where([
                ['fecha_programada', '=', $fecha_validate],
                ['organizacion_id', '=', $organizacion_validate],
                ['oficina_id', '=', $oficina_validate]
            ])
            ->get();

        if (!$validate->isEmpty()) {
            return response()->json([
                "success" => false
            ]);
        }

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

        $visita = Visita::create($solicitud);

        $visita_id = $visita->id;

        $visita_busqueda = DB::table('visitas')
            ->select(
                'visitas.*'
            )
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $visit = $visita_busqueda[0];

        $creador_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $creador = $creador_busqueda[0];

        $editor_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $editor = $editor_busqueda[0];

        return response()->json([
            "success" => true,
            "visita" => $visit,
            "usuario_creacion" => $creador,
            "usuario_actualizacion" => $editor
        ], 201);
    }


    public function show(visita $visita)
    {
        $visita_id = $visita->id;

        $visita_busqueda = DB::table('visitas')
            ->select(
                'visitas.*'
            )
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $visit = $visita_busqueda[0];

        $creador_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $creador = $creador_busqueda[0];

        $editor_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $editor = $editor_busqueda[0];

        return response()->json([
            "success" => true,
            "visita" => $visit,
            "usuario_creacion" => $creador,
            "usuario_actualizacion" => $editor
        ], 201);
    }


    public function update(Request $request, $visita)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;

        $visita->update($solicitud);

        $visita_id = $visita->id;

        $visita_busqueda = DB::table('visitas')
            ->select(
                'visitas.*'
            )
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $visit = $visita_busqueda[0];

        $creador_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $creador = $creador_busqueda[0];

        $editor_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('visitas.id', '=', $visita_id)
            ->get();

        $editor = $editor_busqueda[0];

        return response()->json([
            "success" => true,
            "visita" => $visit,
            "usuario_creacion" => $creador,
            "usuario_actualizacion" => $editor
        ], 201);
    }


    public function destroy(Visita $visita)
    {
        $visita->delete();

        return response()->json(["success" => true], 204);
    }
}
