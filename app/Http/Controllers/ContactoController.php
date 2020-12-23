<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Exports\ConBusquedaExport;
use App\Exports\ConGenExport;
use App\Exports\ContactoExport;
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
            ->select(
                'contactos.id',
                'contactos.nombres',
                'contactos.apellidos',
                'contactos.email',
                'contactos.celular',
                'contactos.cargo',
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

        $contactos = DB::table('detalle_categoria_contactos')
            ->rightJoin('contactos', 'contactos.id', '=', 'detalle_categoria_contactos.contacto_id')
            ->leftJoin('subcategorias', 'subcategorias.id', '=', 'detalle_categoria_contactos.subcategoria_id')
            ->select(
                'contactos.id',
                'contactos.nombres',
                'contactos.apellidos',
                'contactos.email',
                'contactos.celular',
                'contactos.cargo',
                'subcategorias.nombre as subcategoria'
            )
            ->distinct(
                'contactos.updated_at'
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
            "subcategorias" => $subcat_busqueda
        ], 200);
    }


    public function search(Request $request)
    {
        $tipos = $request->input('tipos');
        $palabras = $request->input('palabras');

        $contactos = DB::table('contactos')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->select(
                'contactos.id',
                'contactos.nombres',
                'contactos.apellidos',
                'contactos.email',
                'contactos.celular',
                'contactos.cargo',
                'organizacions.nombre as organizacion',
            )
            ->where([
                [$tipos[0], 'ilike', $palabras[0]],
                [$tipos[2], 'ilike', $palabras[2]],
                [$tipos[3], 'ilike', $palabras[3]]
            ])
            ->orWhere([
                [$tipos[1], 'ilike', $palabras[1]],
                [$tipos[2], 'ilike', $palabras[2]],
                [$tipos[3], 'ilike', $palabras[3]]
            ])
            ->orderBy($tipos[0])
            ->orderByDesc('contactos.updated_at')
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

        $contacto = Contacto::create($solicitud);

        $contacto_id = $contacto->id;

        $contacto_busqueda = DB::table('contactos')
            ->select(
                'contactos.id'
            )
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $cont = $contacto_busqueda[0];

        return response()->json([
            "success" => true,
            "contacto" => $cont
        ], 200);
    }


    public function show(Contacto $contacto)
    {
        $contacto_id = $contacto->id;

        $contacto_busqueda = DB::table('contactos')
            ->select(
                'contactos.*'
            )
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $cont = $contacto_busqueda[0];

        $creador_busqueda = DB::table('contactos')
            ->leftJoin('users', 'users.id', '=', 'contactos.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $usuario_creacion = $creador_busqueda[0];

        $editor_busqueda = DB::table('contactos')
            ->leftJoin('users', 'users.id', '=', 'contactos.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $usuario_actualizacion = $editor_busqueda[0];

        $categorias = DB::table('detalle_categoria_contactos')
            ->select('subcategoria_id')
            ->where('detalle_categoria_contactos.contacto_id', '=', $contacto_id)
            ->orderBy('detalle_categoria_contactos.subcategoria_id')
            ->get();

        $cats = $categorias->pluck('subcategoria_id');

        return response()->json([
            "success" => true,
            "contacto" => $cont,
            "usuario_creacion" => $usuario_creacion,
            "usuario_actualizacion" => $usuario_actualizacion,
            "categorias" => $cats
        ], 200);
    }


    public function update(Request $request, Contacto $contacto)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;

        $contacto->update($solicitud);

        $contacto_id = $contacto->id;

        $contacto_busqueda = DB::table('contactos')
            ->select(
                'contactos.*'
            )
            ->where('contactos.id', '=', $contacto_id)
            ->get();

        $cont = $contacto_busqueda[0];

        return response()->json([
            "success" => true,
            "contacto" => $cont
        ], 200);
    }

    public function destroySubcat(Request $request)
    {
        $contacto_id = $request->input('contacto_id');

        $contacto_busqueda = DB::table('detalle_categoria_contactos')
            ->where('contacto_id', '=', $contacto_id)
            ->delete();

        return response()->json(["success" => true], 200);
    }

    public function destroy(Contacto $contacto)
    {
        $contacto->delete();

        return response()->json(["success" => true], 200);
    }
}
