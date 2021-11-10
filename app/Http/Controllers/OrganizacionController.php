<?php

namespace App\Http\Controllers;

use App\DetalleActividadEconomica;
use App\Exports\OrganizacionExport;
use App\Exports\OrgBusquedaExport;
use App\Exports\OrgGenExport;
use App\Organizacion;
use App\TipoDocumentoOrganizacion;
use App\Categoria;
use App\Pais;
use App\Clase;
use App\Sector;
use App\Ciiu;
use App\TipoOrganizacion;
use Carbon\Carbon;
use DateTime;
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
            ->orderBy('organizacions.nombre')
            ->get();
        $count = count($organizacion_busqueda);
        return response()->json([
            "success" => true,
            "organizaciones" => $organizacion_busqueda,
            "count" => $count
        ], 200);
    }


    public function repFecha(Request $request)
    {
        return Excel::download(new OrganizacionExport($request), 'Reporte de Organizaciones.xlsx');
    }


    public function repBusqueda(Request $request)
    {
        $solicitud = $request->all();

        return Excel::download(new OrgBusquedaExport($solicitud), 'Reporte de Organizaciones.xlsx');
    }


    public function repGen()
    {
        return Excel::download(new OrgGenExport, 'Reporte de Organizaciones.xlsx');
    }


    public function listForms()
    {
        return response()->json([
            'success' => true,
            'documentos' => TipoDocumentoOrganizacion::orderBy('nombre')->get(),
            'categorias' => Categoria::orderBy('nombre')->get(),
            'paises' => Pais::orderBy('nombre')->get(),
            'clases' => Clase::orderBy('nombre')->get(),
            'sectores' => Sector::all(),
            'ciius' => Ciiu::orderBy('codigo')->get(),
            'tipos' => TipoOrganizacion::orderBy('nombre')->get()
        ], 200);
    }

    public function orgSimpleList()
    {
        $organizacion_busqueda = DB::table('organizacions')
            ->select(
                'organizacions.id',
                'organizacions.nombre'
            )
            ->orderBy('organizacions.nombre')
            ->get();

        return response()->json([
            "success" => true,
            "organizaciones" => $organizacion_busqueda
        ], 200);
    }


    public function search(Request $request)
    {
        $numero_documento =  $request->numero_documento;
        $nombre = $request->nombre;
        $razon_social = $request->razon_social;
        $documentos = $request->documentos;
        $categorias = $request->categorias;
        $parametros = $request->parametros; 
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
            ->where([
                [$parametros[0], 'ilike', $numero_documento],
                [$parametros[1], 'ilike', $nombre],
                [$parametros[2], 'ilike', $razon_social]
            ])
            ->when($categorias, function ($query, $categorias) {
                $query->whereIn('organizacions.categoria_id', $categorias);
            })
            ->when($documentos, function ($query, $documentos) {
                $query->whereIn('organizacions.tipo_documento_organizacion_id', $documentos);
            })
            ->orderBy('organizacions.nombre')
            ->orderByDesc('organizacions.estado')
            ->get();
            $count = count($organizacion_busqueda);
        return response()->json([
            "success" => true,
            "organizaciones" => $organizacion_busqueda,
            "count" => $count
        ], 200);
    }

    public function editOrg(Request $request)
    {
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
            ->where('organizacions.id', '=', $request->org_id)
            ->get();

        return response()->json([
            "success" => true,
            "organizacion" => $organizacion_busqueda[0]
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_creacion'] = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $solicitud['numero_documento'] = $solicitud['numero_documento'] ? $solicitud['numero_documento'] : "-";
        $organizacion = Organizacion::create($solicitud);
        $key = $request->actividades;
        if (!empty($key)) {
            $count = count($key);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $detalle['organizacion_id'] = $organizacion->id;
                    $detalle['ciiu_id'] = $key[$i];
                    DetalleActividadEconomica::create($detalle);
                }
            }
        }
        return response()->json([
            "success" => true,
            'organizacion' => $organizacion->id,
            'fecha_desafiliacion' => $solicitud['fecha_desafiliacion']
        ], 200);
    }


    public function show(Organizacion $organizacion)
    {
        $organizacion_busqueda = DB::table('organizacions')
            ->select(
                'organizacions.*'
            )
            ->where('organizacions.id', '=', $organizacion->id)
            ->get();

        $organizacion_busqueda[0]->fecha_afiliacion = $organizacion_busqueda[0]->fecha_afiliacion ? new DateTime($organizacion_busqueda[0]->fecha_afiliacion):null;
        $organizacion_busqueda[0]->fecha_afiliacion = $organizacion_busqueda[0]->fecha_afiliacion ? $organizacion_busqueda[0]->fecha_afiliacion->format('d/m/Y'):null;

        $creador_busqueda = DB::table('organizacions')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_creacion')
            ->select('users.usuario as usuario_creacion')
            ->where('organizacions.id', '=', $organizacion->id)
            ->get();
        $editor_busqueda = DB::table('organizacions')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_actualizacion')
            ->select('users.usuario as usuario_actualizacion')
            ->where('organizacions.id', '=', $organizacion->id)
            ->get();
        $actividades_busqueda = DB::table('detalle_actividad_economicas')
            ->leftJoin('ciius', 'ciius.id', '=', 'detalle_actividad_economicas.ciiu_id')
            ->select(
                'ciius.id',
                'ciius.nombre',
                'ciius.codigo'
            )
            ->where('detalle_actividad_economicas.organizacion_id', '=', $organizacion->id)
            ->orderBy('ciius.id')
            ->get();
        return response()->json([
            "success" => true,
            'organizacion' => $organizacion_busqueda[0],
            'usuario_creacion' => $creador_busqueda[0],
            'usuario_actualizacion' => $editor_busqueda[0],
            'actividades' => $actividades_busqueda
        ], 200);
    }


    public function update(Request $request, Organizacion $organizacion)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $solicitud['numero_documento'] = $solicitud['numero_documento'] ? $solicitud['numero_documento'] : "-";
        $organizacion->update($solicitud);
        $organizacion_id = $organizacion->id;
        DB::table('detalle_actividad_economicas')
            ->where('organizacion_id', '=', $organizacion_id)
            ->delete();
        $key = $request->actividades;
        if (!empty($key)) {
            $count = count($key);
            if ($count > 0) {
                for ($i = 0; $i < $count; $i++) {
                    $detalle['organizacion_id'] = $organizacion->id;
                    $detalle['ciiu_id'] = $key[$i];
                    DetalleActividadEconomica::create($detalle);
                }
            }
        }
        return response()->json([
            "success" => true,
            "organizacion_id" => $organizacion_id
        ], 200);
    }

    public function destroy(Organizacion $organizacion)
    {
        $organizacion->delete();
        return response()->json(["success" => true], 200);
    }
}
