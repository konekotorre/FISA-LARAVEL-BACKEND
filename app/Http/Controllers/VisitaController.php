<?php

namespace App\Http\Controllers;

use App\Visita;
use App\EstadoVisita;
use App\EstadoTarea;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisitaController extends Controller
{

    public function index()
    {
        $visitas = DB::table('visitas')
            ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
            ->join('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
            ->join('users', 'users.id', '=', 'visitas.usuario_asignado')
            ->select(
                'visitas.id',
                'organizacions.nombre as organizacion',
                'visitas.fecha_programada',
                'visitas.titulo',
                'users.usuario',
                'estado_visitas.nombre'
            )
            ->orderBy('visitas.fecha_programada')
            ->get();
        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }


    public function indexByOrganizacion(Request $request)
    {
        $visitas = DB::table('visitas')
            ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
            ->join('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
            ->join('users', 'users.id', '=', 'visitas.usuario_asignado')
            ->select(
                'visitas.id',
                'visitas.fecha_programada',
                'visitas.titulo',
                'users.usuario',
                'estado_visitas.nombre'
            )
            ->where('organizacion.id', '=', $request->organizacion_id)
            ->orderBy('visitas.fecha_programada')
            ->get();
        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }

    public function listForm()
    {
        return response()->json([
            "success" => true,
            "estadoVisitas" => EstadoVisita::orderBy('nombre')->get(),
            "estadoTareas" => EstadoTarea::orderBy('nombre')->get(),
            "usuarios" => User::orderBy('usuario')->get(['usuario', 'id']),
        ], 200);
    }

    public function orgData(Request $request)
    {
        $contacto_busqueda = DB::table('contactos')
            ->join('personas', 'personas.id', 'contactos.persona_id')
            ->select(
                'contactos.id',
                'personas.nombres',
                'personas.apellidos',
                'personas.celular',
                'contactos.email',
                'contactos.telefono',
                'contactos.extension',
                'contactos.oficina_id'
            )
            ->where('contactos.organizacion_id', '=', $request->organizacion_id)
            ->orderBy('contactos.updated_at')
            ->get();
        $oficina_busqueda = DB::table('oficinas')
            ->join('pais', 'pais.id', '=', 'oficinas.pais_id')
            ->join('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
            ->join('departamento_estados', 'departamento_estados.id', '=', 'oficinas.departamento_estado_id')
            ->select(
                'oficinas.id',
                'oficinas.direccion',
                'oficinas.complemento_direccion as complemento',
                'pais.nombre as pais',
                'ciudads.nombre as ciudad',
                'departamento_estados.nombre as departamento_estado'
            )
            ->where('oficinas.organizacion_id', '=', $request->organizacion_id)
            ->orderBy('oficinas.updated_at')
            ->get();
        return response()->json([
            "success" => true,
            "contactos" => $contacto_busqueda,
            "oficinas" => $oficina_busqueda,
        ], 200);
    }


    public function today()
    {
        $now = Carbon::now()->format('Y/m/d');
        $future = Carbon::now()->addDays(7)->format('Y/m/d');
        $visitas = DB::table('visitas')
            ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
            ->join('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
            ->join('users', 'users.id', '=', 'visitas.usuario_asignado')
            ->select(
                'visitas.id',
                'organizacions.nombre as organizacion',
                'visitas.fecha_programada',
                'visitas.titulo',
                'users.usuario',
                'estado_visitas.nombre'
            )
            ->where('visitas.fecha_programada', '>=', $now)
            ->where('visitas.fecha_programada', '<=', $future)
            ->orderBy('visitas.fecha_programada')
            ->get();
        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }


    public function search(Request $request)
    {
        $tipo = $request->tipo;
        $palabra = $request->palabra;
        if ($tipo == "titulo") {
            $palabra_final = '%' . $palabra . '%';
            $visitas = DB::table('visitas')
                ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
                ->join('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
                ->join('users', 'users.id', '=', 'visitas.usuario_asignado')
                ->select(
                    'visitas.id',
                    'organizacions.nombre as organizacion',
                    'visitas.fecha_programada',
                    'visitas.titulo',
                    'users.usuario',
                    'estado_visitas.nombre'
                )
                ->where('visitas.titulo', 'ilike', $palabra_final)
                ->orderBy('visitas.fecha_programada')
                ->get();
        } elseif ($tipo == "organizacion") {
            $palabra_final = '%' . $palabra . '%';
            $visitas = DB::table('visitas')
                ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
                ->join('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
                ->join('users', 'users.id', '=', 'visitas.usuario_asignado')
                ->select(
                    'visitas.id',
                    'organizacions.nombre as organizacion',
                    'visitas.fecha_programada',
                    'visitas.titulo',
                    'users.usuario',
                    'estado_visitas.nombre'
                )->where('organizacions.nombre', 'ilike', $palabra_final)
                ->orderBy('visitas.fecha_programada')
                ->get();
        } else {
            return response()->json(["success" => false], 404);
        }
        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();
        $fecha_validate = $solicitud['fecha_programada'];
        $organizacion_validate = $solicitud['organizacion_id'];
        $validate = DB::table('visitas')
            ->select('fecha_programada')
            ->where([
                ['fecha_programada', '=', $fecha_validate],
                ['organizacion_id', '=', $organizacion_validate]
            ])
            ->get();
        if (!$validate->isEmpty()) {
            return response()->json([
                "success" => false
            ]);
        }
        $creador_auth = Auth::user();
        $solicitud['usuario_creacion'] = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $visita = Visita::create($solicitud);
        return response()->json([
            "success" => true,
            "visita" => $visita->id
        ], 200);
    }


    public function show(visita $visita)
    {
        $visita_busqueda = DB::table('visitas')
            ->select(
                'visitas.*'
            )
            ->where('visitas.id', '=', $visita->id)
            ->get();

        $creador_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('visitas.id', '=', $visita->id)
            ->get();

        $editor_busqueda = DB::table('visitas')
            ->join('users', 'users.id', '=', 'visitas.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('visitas.id', '=', $visita->id)
            ->get();

        return response()->json([
            "success" => true,
            "visita" => $visita_busqueda[0],
            "usuario_creacion" => $creador_busqueda[0],
            "usuario_actualizacion" => $editor_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Visita $visita)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $visita->update($solicitud);
        return response()->json([
            "success" => true,
            "visita" => $visita->id
        ], 200);
    }


    public function destroy(Visita $visita)
    {
        DB::table('tareas')
            ->where('tareas.visita_id', $visita->id)
            ->delete();
        $visita->delete();
        return response()->json(["success" => true], 200);
    }
}
