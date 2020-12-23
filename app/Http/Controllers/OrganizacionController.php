<?php

namespace App\Http\Controllers;

use App\Exports\OrganizacionExport;
use App\Exports\OrgBusquedaExport;
use App\Exports\OrgGenExport;
use App\Organizacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrganizacionController extends Controller
{

    public function index()
    {
        $organizacion_busqueda = DB::table('organizacions')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
            ->leftJoin('subsectors', 'subsectors.id', '=', 'organizacions.subsector_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->select(
                'organizacions.id',
                'organizacions.nombre',
                'tipo_documento_organizacions.nombre as tipo_documento_organizacion',
                'organizacions.numero_documento',
                'organizacions.razon_social',
                'categorias.nombre as categoria',
                'subsectors.nombre as subsector'
            )
            ->orderByDesc('organizacions.updated_at')
            ->get();

        return response()->json([
            "success" => true,
            "organizaciones" => $organizacion_busqueda
        ], 200);
    }


    public function repFecha(Request $request)
    {

        return Excel::download(new OrganizacionExport($request), 'Reporte de Organizaciones.xlsx.xlsx');
    }

    public function repBusqueda(Request $request)
    {

        $solicitud = $request->all();

        return Excel::download(new OrgBusquedaExport($solicitud), 'Reporte de Organizaciones.xlsx.xlsx');
    }

    public function repGen()
    {
        return Excel::download(new OrgGenExport, 'Reporte de Organizaciones.xlsx');
    }

    public function listForms()
    {
        $documento_busqueda = DB::table('tipo_documento_organizacions')
            ->select(
                'tipo_documento_organizacions.id',
                'tipo_documento_organizacions.nombre'
            )
            ->orderBy('tipo_documento_organizacions.nombre')
            ->get();

        $categoria_busqueda = DB::table('categorias')
            ->select(
                'categorias.id',
                'categorias.nombre'
            )
            ->get();

        $pais_busqueda = DB::table('pais')
            ->select(
                'pais.id',
                'pais.nombre',
            )
            ->orderBy('pais.nombre')
            ->get();

        $clase_busqueda = DB::table('clases')
            ->select(
                'clases.id',
                'clases.nombre'
            )
            ->get();

        $sector_busqueda = DB::table('sectors')
            ->select(
                'sectors.id',
                'sectors.nombre'
            )
            ->orderBy('sectors.id')
            ->get();

        $ciiu_busqueda = DB::table('ciius')
            ->select(
                'ciius.nombre',
                'ciius.id',
                'ciius.codigo'
            )
            ->get();

        $tipo_busqueda = DB::table('tipo_organizacions')
            ->select(
                'tipo_organizacions.id',
                'tipo_organizacions.nombre'
            )
            ->orderBy('tipo_organizacions.nombre')
            ->get();

        return response()->json([
            'success' => true,
            'documentos' => $documento_busqueda,
            'categorias' => $categoria_busqueda,
            'paises' => $pais_busqueda,
            'clases' => $clase_busqueda,
            'sectores' => $sector_busqueda,
            'ciius' => $ciiu_busqueda,
            'tipos' => $tipo_busqueda
        ], 200);
    }


    public function orgSimpleList()
    {
        $organizacion_busqueda = DB::table('organizacions')
            ->select(
                'organizacions.id',
                'organizacions.nombre'
            )
            ->orderByDesc('organizacions.nombre')
            ->get();

        return response()->json([
            "success" => true,
            "organizaciones" => $organizacion_busqueda
        ], 200);
    }


    public function search(Request $request)
    {
        $tipos = $request->input('tipos');
        $palabras = $request->input('palabras');

        $orgs = DB::table('organizacions')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
            ->leftJoin('subsectors', 'subsectors.id', '=', 'organizacions.subsector_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->select(
                'organizacions.id',
                'organizacions.nombre',
                'tipo_documento_organizacions.nombre as tipo_documento_organizacion',
                'organizacions.numero_documento',
                'organizacions.razon_social',
                'categorias.nombre as categoria',
                'subsectors.nombre as subsector'
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
            ->orderByDesc('organizacions.updated_at')
            ->get();

        return response()->json([
            "success" => true,
            "organizaciones" => $orgs
        ], 200);
    }


    public function editOrg(Request $request)
    {
        $org_id = $request->input('org_id');

        $organizacion_busqueda = DB::table('organizacions')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->leftJoin('subsectors', 'subsectors.id', '=', 'organizacions.subsector_id')
            ->leftJoin('pais', 'pais.id', '=', 'organizacions.pais_id')
            ->select(
                'organizacions.id',
                'organizacions.nombre',
                'tipo_documento_organizacions.nombre as tipo_documento_organizacion',
                'organizacions.numero_documento',
                'organizacions.razon_social',
                'categorias.nombre as categoria',
                'subsectors.nombre as subsector',
                'pais.nombre as pais',
                'organizacions.estado'
            )
            ->where('organizacions.id', '=', $org_id)
            ->get();

        $organizacion = $organizacion_busqueda[0];

        return response()->json([
            "success" => true,
            "organizacion" => $organizacion
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $numero_validate = $solicitud['numero_documento'];
        $nombre_validate = $solicitud['nombre'];
        $categoria_validate = $solicitud['categoria_id'];

        $validate = DB::table('organizacions')
            ->select('numero_documento', 'razon_social')
            ->where([
                ['numero_documento', '=', $numero_validate],
                ['nombre', '=', $nombre_validate],
                ['categoria_id', '=', $categoria_validate]
            ])
            ->get();

        if (!$validate->isEmpty()) {
            return response()->json([
                "success" => false
            ]);
        } else {

            //CREACION DE ORGANIZACION

            $creador_auth = Auth::user();
            $creador = $creador_auth['id'];

            $solicitud['usuario_creacion'] = $creador;
            $solicitud['usuario_actualizacion'] = $creador;

            $organizacion = Organizacion::create($solicitud);

            //BUSQUEDAS PARA REGRESO DE DATOS RELACIONADOS

            $org_id = $organizacion->id;

            $org = DB::table('organizacions')
                ->select(
                    'id'
                )
                ->where('organizacions.id', '=', $org_id)
                ->get();

            $empresa = $org[0];

            $creador_busqueda = DB::table('organizacions')
                ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_creacion')
                ->select('users.usuario as usuario_creacion')
                ->where('organizacions.id', '=', $org_id)
                ->get();

            $usuario_creacion = $creador_busqueda[0];

            $editor_busqueda = DB::table('organizacions')
                ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_actualizacion')
                ->select('users.usuario as usuario_actualizacion')
                ->where('organizacions.id', '=', $org_id)
                ->get();

            $usuario_actualizacion = $editor_busqueda[0];

            //RETORNO DE DATOS

            return response()->json([
                "success" => true,
                'organizacion' => $empresa,
                'usuario_creacion' => $usuario_creacion,
                'usuario_actualizacion' => $usuario_actualizacion
            ], 200);
        }
    }


    public function show(Organizacion $organizacion)
    {
        //BUSQUEDAS PARA REGRESO DE DATOS RELACIONADOS

        $org_id = $organizacion->id;

        $org = DB::table('organizacions')
            ->select(
                'organizacions.*'
            )
            ->where('organizacions.id', '=', $org_id)
            ->get();

        $empresa = $org[0];

        $creador_busqueda = DB::table('organizacions')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('organizacions.id', '=', $org_id)
            ->get();

        $creador = $creador_busqueda[0];

        $editor_busqueda = DB::table('organizacions')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('organizacions.id', '=', $org_id)
            ->get();

        $editor = $editor_busqueda[0];

        $actividades_busqueda = DB::table('detalle_actividad_economicas')
            ->select('ciiu_id')
            ->where('organizacion_id', '=', $org_id)
            ->orderBy('ciiu_id')
            ->get();

        $actividades = $actividades_busqueda->pluck('ciiu_id');

        //RETORNO DE DATOS

        return response()->json([
            "success" => true,
            'organizacion' => $empresa,
            'usuario_creacion' => $creador,
            'usuario_actualizacion' => $editor,
            'actividades' => $actividades
        ], 200);
    }


    public function update(Request $request, Organizacion $organizacion)
    {
        //ACTUALIZACION DE DATOS
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador;

        $organizacion->update($solicitud);

        //RETORNO DE DATOS

        return response()->json([
            "success" => true
        ], 200);
    }

    public function destroyActividad(Request $request)
    {
        $organizacion_id = $request->input('organizacion_id');

        $organizacion_busqueda = DB::table('detalle_actividad_economicas')
            ->where('organizacion_id', '=', $organizacion_id)
            ->delete();

        return response()->json(["success" => true], 200);
    }

    public function destroy(Organizacion $organizacion)
    {
        $organizacion->delete();

        return response()->json(["success" => true], 200);
    }
}
