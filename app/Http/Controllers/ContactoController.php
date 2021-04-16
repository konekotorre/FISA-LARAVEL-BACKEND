<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\DetalleCategoriaPersona;
use App\Exports\ConBusquedaExport;
use App\Exports\ConGenExport;
use App\Exports\ContactoExport;
use App\Persona;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
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
            ->orderByDesc('contactos.updated_at')
            ->get();

        return response()->json([
            "success" => true,
            'contactos' => $contactos
        ], 200);
    }

    public function indexByOrganizacion(Request $request)
    {
        $organizacion_id = $request->input('organizacion_id');

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
            ->where('contactos.organizacion_id', '=', $organizacion_id)
            ->orderByDesc('contactos.updated_at')
            ->get();

        return response()->json([
            "success" => true,
            "contactos" => $contactos
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
        $sexo_busqueda = DB::table('sexos')
            ->select(
                'sexos.*'
            )
            ->orderBy('sexos.nombre')
            ->get();

        $tipo_busqueda = DB::table('tipo_documento_personas')
            ->select(
                'tipo_documento_personas.id',
                'tipo_documento_personas.nombre'
            )
            ->orderBy('tipo_documento_personas.nombre')
            ->get();

        $subcat_busqueda = DB::table('subcategorias')
            ->select(
                'subcategorias.id',
                'subcategorias.nombre'
            )
            ->orderBy('subcategorias.id')
            ->get();

        return response()->json([
            "success" => true,
            "tipos" => $tipo_busqueda,
            "subcategorias" => $subcat_busqueda,
            "sexos" => $sexo_busqueda
        ], 200);
    }


    public function search(Request $request)
    {
        $nombres = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $organizacion = $request->input('organizacion');
        $cargo = $request->input('cargo');
        $email = $request->input('email');
        $pais = $request->input('pais');
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

            ->distinct('contactos.updated_at')

            ->orderByDesc('contactos.updated_at')
            ->orderBy('personas.nombres')
            ->orderBy('personas.apellidos')
            ->get();

        return response()->json([
            "success" => true,
            "contactos" => $contactos
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

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
                    $creador,
                    Carbon::now(),
                    $solicitud['persona_id']
                ]
            );
        }

        $categorias_eliminar = DB::table('detalle_categoria_personas')
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

        $contacto = Contacto::create($solicitud);

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Contacto $contacto)
    {
        $contacto_id = $contacto->id;

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
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $cont = $contacto_busqueda[0];

        $persona_id = $contacto_busqueda->pluck('persona_id');

        $categorias = DB::table('detalle_categoria_personas')
            ->select('subcategoria_id')
            ->where('detalle_categoria_personas.persona_id', '=', $persona_id)
            ->orderBy('detalle_categoria_personas.subcategoria_id')
            ->get();

        $creador = DB::table('contactos')
            ->join('users', 'users.id', '=', 'contactos.usuario_creacion')
            ->select('users.usuario')
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $editor = DB::table('contactos')
            ->join('users', 'users.id', '=', 'contactos.usuario_actualizacion')
            ->select('users.usuario')
            ->where('contactos.id', '=', $contacto_id)
            ->get();


        $cats = $categorias->pluck('subcategoria_id');

        return response()->json([
            "success" => true,
            "contacto" => $cont,
            "categorias" => $cats,
            "usuario_creacion" => $creador[0],
            "usuario_actualizacion" => $editor[0]
        ], 200);
    }


    public function update(Request $request, Contacto $contacto)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;
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
                    $creador,
                    Carbon::now(),
                    $solicitud['persona_id']
                ]
            );
        }

        $categorias_eliminar = DB::table('detalle_categoria_personas')
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

        $contacto->update($solicitud);

        return response()->json([
            "success" => true
        ], 200);
    }

    public function destroy(Contacto $contacto)
    {
        $contacto_id = $contacto->id;

        $persona_id = DB::table('contactos')
            ->select('persona_id')
            ->where('id', '=', $contacto_id)
            ->get();

        $id_temp = $persona_id->pluck('persona_id');

        $id = $id_temp[0];

        $contactos = DB::table('contactos')
            ->select('id')
            ->where('persona_id', '=', $id)
            ->get();

        $count = $contactos->count();

        if ($count == 1) {

            $contacto->delete();

            DB::table('personas')
                ->where('id', '=', $id)
                ->delete();
        } else {

            $contacto->delete();
        }
        return response()->json(["success" => true], 200);
    }
}
