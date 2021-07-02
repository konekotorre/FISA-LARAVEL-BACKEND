<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\DetalleCategoriaPersona;
use App\Exports\ConBusquedaExport;
use App\Exports\ConGenExport;
use App\Exports\ContactoExport;
use App\Persona;
use App\Sexo;
use App\TipoDocumentoPersona;
use App\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContactoController extends Controller
{

    public function index()
    {
        $contactos = DB::table('contactos')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->select(
                'contactos.id as contacto_id',
                'personas.id as persona_id',
                'personas.nombres',
                'personas.apellidos',
                'contactos.email',
                'personas.celular',
                'contactos.telefono',
                'contactos.extension',
                'contactos.cargo',
                'contactos.observaciones',
                'organizacions.nombre as organizacion',
            )
            ->orderBy('personas.nombres')
            ->orderBy('personas.apellidos')
            ->orderByDesc('contactos.estado')
            ->get();
        $count = count($contactos);
        return response()->json([
            "success" => true,
            'contactos' => $contactos,
            "count" => $count
        ], 200);
    }

    public function indexByOrganizacion(Request $request)
    {
        $contactos = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->select(
                'contactos.id as contacto_id',
                'personas.id as persona_id',
                'personas.nombres',
                'personas.apellidos',
                'contactos.email',
                'personas.celular',
                'contactos.telefono',
                'contactos.extension',
                'contactos.cargo',
                'contactos.observaciones'
            )
            ->where('contactos.organizacion_id', '=', $request->organizacion_id)
            ->orderBy('personas.nombres')
            ->orderBy('personas.apellidos')
            ->orderByDesc('contactos.estado')
            ->get();
        return response()->json([
            "success" => true,
            "contactos" => $contactos,
        ], 200);
    }

    public function repFecha(Request $request)
    {
        return Excel::download(new ContactoExport($request), 'Reporte de Contactos.xlsx');
    }

    public function repBusqueda(Request $request)
    {
        $solicitud = $request->all();
        return Excel::download(new ConBusquedaExport($solicitud), 'Reporte de Contactos.xlsx');
    }

    public function repGen()
    {
        return Excel::download(new ConGenExport, 'Reporte de Contactos.xlsx');
    }

    public function listForms()
    {
        return response()->json([
            "success" => true,
            "tipos" => TipoDocumentoPersona::orderBy('nombre')->get(),
            "subcategorias" => Subcategoria::orderBy('nombre')->get(),
            "sexos" => Sexo::orderBy('nombre')->get()
        ], 200);
    }


    public function search(Request $request)
    {
        $nombres = $request->nombres;
        $apellidos = $request->apellidos;
        $organizacion = $request->organizacion;
        $cargo = $request->cargo;
        $email = $request->email;
        $pais = $request->pais;
        $categorias = $request->categorias;
        $subcategorias = $request->subcategorias;
        $parametros = $request->parametros;
        $contactos = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->leftJoin('oficinas', 'oficinas.id', '=', 'contactos.oficina_id')
            ->leftJoin('pais', 'pais.id', 'oficinas.pais_id')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->leftJoin('detalle_categoria_personas', 'detalle_categoria_personas.persona_id', '=', 'personas.id')
            ->select(
                'contactos.id as contacto_id',
                'personas.id as persona_id',
                'personas.nombres',
                'personas.apellidos',
                'contactos.email',
                'personas.celular',
                'contactos.telefono',
                'contactos.extension',
                'contactos.cargo',
                'contactos.observaciones',
                'organizacions.nombre as organizacion',
            )
            ->where([
                [$parametros[0], 'ilike', $nombres],
                [$parametros[1], 'ilike', $apellidos],
                [$parametros[2], 'ilike', $organizacion],
                [$parametros[3], 'ilike', $cargo],
                [$parametros[4], 'ilike', $email],
                [$parametros[5], $parametros[8], $pais]
            ])
            ->whereIn($parametros[6], $categorias)
            ->whereIn($parametros[7], $subcategorias)
            ->distinct('contactos.id')
            ->orderBy('personas.nombres')
            ->orderBy('personas.apellidos')
            ->orderByDesc('contactos.estado')
            ->orderBy('contactos.id')
            ->get();
        $count = count($contactos);
        return response()->json([
            "success" => true,
            "contactos" => $contactos,
            "count" => $count
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_creacion'] = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        if ($solicitud['persona_id'] == null) {
            $persona = Persona::create($solicitud);
            $solicitud['persona_id'] = $persona->id;
        } else {
            DB::update(
                'update personas set(tipo_documento_persona_id, numero_documento, nombres, 
                    apellidos, celular, sexo_id, usuario_actualizacion, updated_at) 
                        = (?, ?, ?, ?, ?, ?, ?, ?) where id = ?',
                [
                    $solicitud['tipo_documento_persona_id'],
                    $solicitud['numero_documento'],
                    $solicitud['nombres'],
                    $solicitud['apellidos'],
                    $solicitud['celular'],
                    $solicitud['sexo_id'],
                    $creador_auth['id'],
                    Carbon::now(),
                    $solicitud['persona_id']
                ]
            );
        }
        DB::table('detalle_categoria_personas')
            ->where('persona_id', '=', $solicitud['persona_id'])
            ->delete();
        $key = $request->categorias;
        if (!empty($key)) {
            $count = count($key);
            for ($i = 0; $i < $count; $i++) {
                $categoria['persona_id'] = $solicitud['persona_id'];
                $categoria['subcategoria_id'] = $key[$i];
                DetalleCategoriaPersona::create($categoria);
            }
        }
        Contacto::create($solicitud);
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Contacto $contacto)
    {
        $contacto_busqueda = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->select(
                'contactos.*',
                'personas.id as persona_id',
                'personas.nombres',
                'personas.apellidos',
                'personas.tipo_documento_persona_id',
                'personas.numero_documento',
                'personas.sexo_id',
                'personas.celular'
            )
            ->where('contactos.id', '=', $contacto->id)
            ->get();
        $categorias = DB::table('detalle_categoria_personas')
            ->select('subcategoria_id')
            ->where('detalle_categoria_personas.persona_id', '=', $contacto_busqueda->pluck('persona_id'))
            ->orderBy('detalle_categoria_personas.subcategoria_id')
            ->get();
        $creador = DB::table('contactos')
            ->join('users', 'users.id', '=', 'contactos.usuario_creacion')
            ->select('users.usuario')
            ->where('contactos.id', '=', $contacto->id)
            ->get();
        $editor = DB::table('contactos')
            ->join('users', 'users.id', '=', 'contactos.usuario_actualizacion')
            ->select('users.usuario')
            ->where('contactos.id', '=', $contacto->id)
            ->get();
        return response()->json([
            "success" => true,
            "contacto" => $contacto_busqueda[0],
            "categorias" => $categorias->pluck('subcategoria_id'),
            "usuario_creacion" => $creador[0],
            "usuario_actualizacion" => $editor[0]
        ], 200);
    }


    public function update(Request $request, Contacto $contacto)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        if ($solicitud['persona_id'] == null) {
            $persona = Persona::create($solicitud);
            $solicitud['persona_id'] = $persona->id;
        } else {
            DB::update(
                'update personas set(tipo_documento_persona_id, numero_documento, nombres, 
                    apellidos, celular, sexo_id, usuario_actualizacion, updated_at) 
                        = (?, ?, ?, ?, ?, ?, ?, ?) where id = ?',
                [
                    $solicitud['tipo_documento_persona_id'],
                    $solicitud['numero_documento'],
                    $solicitud['nombres'],
                    $solicitud['apellidos'],
                    $solicitud['celular'],
                    $solicitud['sexo_id'],
                    $creador_auth['id'],
                    Carbon::now(),
                    $solicitud['persona_id']
                ]
            );
        }
        DB::table('detalle_categoria_personas')
            ->where('persona_id', '=', $solicitud['persona_id'])
            ->delete();
        $key = $request->categorias;
        if (!empty($key)) {
            for ($i = 0; $i < count($key); $i++) {
                $categoria['persona_id'] = $solicitud['persona_id'];
                $categoria['subcategoria_id'] = $key[$i];
                DetalleCategoriaPersona::create($categoria);
            }
        }
        $contacto->update($solicitud);
        return response()->json([
            "success" => true
        ], 200);
    }

    public function destroy(Contacto $contacto)
    {
        $persona_id = DB::table('contactos')
            ->select('persona_id')
            ->where('id', '=', $contacto->id)
            ->get();
        $id_temp = $persona_id->pluck('persona_id');
        $contactos = DB::table('contactos')
            ->select('id')
            ->where('persona_id', '=', $id_temp[0])
            ->get();
        if ($contactos->count() == 1) {
            $contacto->delete();
            DB::table('personas')
                ->where('id', '=', $id_temp[0])
                ->delete();
        } else {
            $contacto->delete();
        }
        return response()->json(["success" => true], 200);
    }
}
