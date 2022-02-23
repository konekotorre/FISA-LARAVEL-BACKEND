<?php

namespace App\Http\Controllers;

use App\DetalleAsignadoVisita;
use App\Visita;
use App\EstadoVisita;
use App\EstadoTarea;
use App\MotivoTarea;
use App\MotivoVisita;
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
        ->leftJoin('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
        ->leftJoin('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
        ->leftJoin('motivo_visitas', 'motivo_visitas.id', '=', 'visitas.motivo_id')
            ->select(
                'visitas.id',
                'organizacions.nombre as organizacion',
                'visitas.fecha_programada',
                'motivo_visitas.nombre as motivo',
                'estado_visitas.nombre as estado',
                (DB::raw("select count('id') as totalTareas from tareas join visitas on tareas.visita_id = visitas.id"))
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
        ->leftJoin('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
        ->leftJoin('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
        ->leftJoin('motivo_visitas', 'motivo_visitas.id', '=', 'visitas.motivo_id')
            ->select(
                'visitas.id',
                'visitas.fecha_programada',
                'motivo_visitas.nombre as motivo',
                'estado_visitas.nombre as estado'
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
        $users = DB::table('users')
            ->join('tipo_documento_personas', 'tipo_documento_personas.id', '=', 'users.tipo_documento_persona_id')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.usuario',
            )
            ->where('model_has_roles.role_id', '!=', 1)
            ->orderBy('users.usuario')
            ->get();
        return response()->json([
            "success" => true,
            "estadoVisitas" => EstadoVisita::orderBy('nombre')->get(),
            "estadoTareas" => EstadoTarea::orderBy('nombre')->get(),
            "motivoVisitas" => MotivoVisita::orderBy('nombre')->get(),
            "motivoTareass" => MotivoTarea::orderBy('nombre')->get(),
            "usuarios" => $users,
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
        ->leftJoin('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
        ->leftJoin('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
        ->leftJoin('motivo_visitas', 'motivo_visitas.id', '=', 'visitas.motivo_id')
            ->select(
                'visitas.id',
                'organizacions.nombre as organizacion',
                'visitas.fecha_programada',
                'motivo_visitas.nombre as motivo',
                'estado_visitas.nombre as estado'
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
        $organizacion = $request->organizacion ? trim($request->organizacion) : null;
        $motivo = $request->palabra ? $request->palabra : null;
        $fecha_inicio = $request->fecha_inicio ? $request->fecha_inicio : null;
        $fecha_fin = $request->fecha_fin ? $request->fecha_fin : null;

        $visitas = DB::table('visitas')
        ->leftJoin('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
        ->leftJoin('estado_visitas', 'estado_visitas.id', '=', 'visitas.estado_id')
        ->leftJoin('motivo_visitas', 'motivo_visitas.id', '=', 'visitas.motivo_id')
        ->select(
            'visitas.id',
            'organizacions.nombre as organizacion',
            'visitas.fecha_programada',
            'motivo_visitas.nombre as motivo',
            'estado_visitas.nombre as estado'
        )
            ->when($organizacion, function ($query, $organizacion) {
                $query->where('organizacions.nombre', 'ilike', '%' . $organizacion . '%');
            })
            ->when($motivo, function ($query, $motivo) {
                $query->where('visitas.motivo_id', $motivo);
            })
            ->when($fecha_inicio, function ($query, $fecha_inicio) {
                $query->where('visitas.fecha_programada', '>=',  $fecha_inicio);
            })
            ->when($fecha_fin, function ($query, $fecha_fin) {
                $query->where('visitas.fecha_programada', '<=', $fecha_fin);
            })
            ->orderBy('visitas.fecha_programada')
            ->get();

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
        $asignados = $request->asignados;
        if (!empty($asignados)) {
            $count = count($asignados);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $usuarios['visita_id'] = $visita->id;
                    $usuarios['asignado_id'] = $asignados[$i];
                    DetalleAsignadoVisita::create($usuarios);
                }
            }
        }
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
        $asignados = DB::table('detalle_asignado_visitas')
            ->leftJoin('users', 'users.id', '=', 'detalle_asignado_visitas.asignado_id')
            ->select('users.id', 'users.usuario')
            ->where('detalle_asignado_visitas.visita_id', $visita->id)
            ->orderBy('users.usuario')
            ->get();
        return response()->json([
            "success" => true,
            "visita" => $visita_busqueda[0],
            'asignados' => $asignados,
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
        DB::table('detalle_asignado_visitas')
            ->where('visita_id', '=', $visita->id)
            ->delete();
        $asignados = $request->asignados;
        if (!empty($asignados)) {
            $count = count($asignados);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $usuarios['visita_id'] = $visita->id;
                    $usuarios['asignado_id'] = $asignados[$i];
                    DetalleAsignadoVisita::create($usuarios);
                }
            }
        }
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
