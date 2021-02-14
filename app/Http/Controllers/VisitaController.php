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
        $organizacion_id = $request->organizacion_id;

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
            ->where('organizacion.id', '=', $organizacion_id)
            ->orderBy('visitas.fecha_programada')
            ->get();

        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }

    public function listForm()
    {

        $estado_busqueda_v = DB::table('estado_visitas')
            ->select('*')
            ->get();

        $estado_busqueda_t = DB::table('estado_tareas')
            ->select('*')
            ->get();

        $usuario_busqueda = DB::table('users')
            ->select('usuario', 'id')
            ->get();

        return response()->json([
            "success" => true,
            "estadoVisitas" => $estado_busqueda_v,
            "estadoTareas" => $estado_busqueda_t,
            "usuarios" => $usuario_busqueda,
        ], 200);
    }

    public function orgData(Request $request)
    {
        $org_id = $request->organizacion_id;

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
            ->where('contactos.organizacion_id', '=', $org_id)
            ->orderBy('contactos.updated_at')
            ->get();

        $oficina_busqueda = DB::table('oficinas')
            ->join('pais', 'pais.id', '=', 'oficinas.pais_id')
            ->join('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
            ->select(
                'oficinas.id',
                'oficinas.direccion',
                'oficinas.complemento_direccion as complemento',
                'pais.nombre as pais',
                'ciudads.nombre as ciudad'
            )
            ->where('oficinas.organizacion_id', '=', $org_id)
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
        $now = now();

        $visitas = DB::table('visitas')
            ->join('organizacions', 'organizacions.id', '=', 'visitas.organizacion_id')
            ->select(
                'visitas.id',
                'organizacions.nombre as organizacion',
                'visitas.fecha_programada',
                'visitas.fecha_ejecución',
                'visitas.titulo',
                'users.usuario',
                'visitas.estado'
            )
            ->orderBy('fecha_programada')
            ->orderBy('titulo')
            ->get();

        return response()->json([
            "success" => true,
            "visitas" => $visitas
        ], 200);
    }


    public function search(Request $request)
    {
        $tipo = $request->input('tipo');
        $palabra = $request->input('palabra');

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
        $creador = $creador_auth['id'];

        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

        $visita = Visita::create($solicitud);

        $visita_id = $visita->id;

        return response()->json([
            "success" => true,
            "visita" => $visita_id
        ], 200);
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
        ], 200);
    }


    public function update(Request $request, Visita $visita)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;

        $visita->update($solicitud);

        $visita_id = $visita->id;

        return response()->json([
            "success" => true,
            "visita" => $visita_id
        ], 200);
    }


    public function destroy(Visita $visita)
    {
        $visita_id = $visita->id;

        DB::table('tareas')
            ->where('tareas.visita_id', $visita_id)
            ->delete();

        $visita->delete();

        return response()->json(["success" => true], 200);
    }
}
