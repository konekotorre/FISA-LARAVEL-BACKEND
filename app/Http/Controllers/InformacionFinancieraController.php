<?php

namespace App\Http\Controllers;

use App\Exports\InfoFinancieraExport;
use App\Exports\InfoFinBusquedaExport;
use App\Exports\InfoFinGenExport;
use App\InformacionFinanciera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InformacionFinancieraController extends Controller
{

    public function show(Request $request)
    {
        $organizacion_id = $request->input('organizacion_id');

        $infoFinanciera_busqueda = DB::table('informacion_financieras')
            ->select(
                'informacion_financieras.*'
            )
            ->where('informacion_financieras.organizacion_id', '=', $organizacion_id)
            ->get();

        if (empty($infoFinanciera_busqueda[0])) {
            return response()->json(["success" => false], 200);
        } else {

            $informacion = $infoFinanciera_busqueda[0];

            $creador_busqueda = DB::table('informacion_financieras')
                ->leftJoin('users', 'users.id', '=', 'informacion_financieras.usuario_creacion')
                ->select('users.usuario as creador')
                ->where('informacion_financieras.organizacion_id', '=', $organizacion_id)
                ->get();

            $usuario_creacion = $creador_busqueda[0];

            $editor_busqueda = DB::table('informacion_financieras')
                ->leftJoin('users', 'users.id', '=', 'informacion_financieras.usuario_actualizacion')
                ->select('users.usuario as editor')
                ->where('informacion_financieras.organizacion_id', '=', $organizacion_id)
                ->get();

            $usuario_actualizacion = $editor_busqueda[0];

            $importaciones_busqueda = DB::table('importaciones')
                ->select('pais_id')
                ->where('organizacion_id', '=', $organizacion_id)
                ->get();

            $importaciones = $importaciones_busqueda->pluck('pais_id');

            $exportaciones_busqueda = DB::table('exportaciones')
                ->select('pais_id')
                ->where('organizacion_id', '=', $organizacion_id)
                ->get();

            $exportaciones = $exportaciones_busqueda->pluck('pais_id');

            return response()->json([
                "success" => true,
                "informacion" => $informacion,
                "importaciones" => $importaciones,
                "exportaciones" => $exportaciones,
                "usuario_creacion" => $usuario_creacion,
                "usuario_actualizacion" => $usuario_actualizacion
            ], 200);
        }
    }

    public function repFecha(Request $request)
    {

        return Excel::download(new InfoFinancieraExport($request), 'Reporte Financiero.xlsx');
    }

    public function repBusqueda(Request $request)
    {

        $solicitud = $request->all();

        return Excel::download(new InfoFinBusquedaExport($solicitud), 'Reporte Financiero.xlsx');
    }

    public function repGen()
    {
        return Excel::download(new InfoFinGenExport, 'Reporte Financiero.xlsx');
    }

    public function listForms()
    {
        $clasificaciones_busqueda = DB::table('clasificacions')
            ->select(
                'clasificacions.id',
                'clasificacions.nombre',
                'clasificacions.cuota_anual',
                'clasificacions.temporada_cuota'
            )
            ->orderBy('clasificacions.nombre')
            ->get();

        $regimen_busqueda = DB::table('regimens')
            ->select(
                'regimens.id',
                'regimens.nombre'
            )
            ->orderBy('regimens.nombre')
            ->get();

        $pais_busqueda = DB::table('pais')
            ->select(
                'pais.id',
                'pais.nombre'
            )
            ->orderBy('pais.nombre')
            ->get();

        return response()->json([
            "success" => true,
            "clasificaciones" => $clasificaciones_busqueda,
            "regimenes" => $regimen_busqueda,
            "paises" => $pais_busqueda
        ], 200);
    }

    public function clasiInfo(Request $request)
    {
        $clasi_id = $request->input('clasificacion_id');

        $info = DB::table('clasificacions')
            ->select('cuota_anual', 'temporada_cuota')
            ->where('id', '=', $clasi_id)
            ->get();

        $info_salida = $info[0];

        return response()->json([
            "success" => true,
            "informacion" => $info_salida
        ], 200);
    }

    public function store(Request $request)
    {
        $solicitud = $request->all();

        $org_id = $solicitud['organizacion_id'];

        $organizacion_validate = DB::table('informacion_financieras')
            ->select(
                'id'
            )
            ->where('organizacion_id', '=', $org_id)
            ->first();

        if (empty($organizacion_validate)) {

            $creador_auth = Auth::user();
            $creador = $creador_auth['id'];

            $solicitud['usuario_creacion'] = $creador;
            $solicitud['usuario_actualizacion'] = $creador;

            $informacionFinanciera = InformacionFinanciera::create($solicitud);

            $info_id = $informacionFinanciera->id;

            $infoFinanciera = DB::table('informacion_financieras')
                ->select(
                    'informacion_financieras.*'
                )
                ->where('id', '=', $info_id)
                ->get();

            $informacion = $infoFinanciera[0];

            $info_updated = $informacionFinanciera->updated_at;
            $info_editor = $informacionFinanciera->usuario_actualizacion;
            $info_org = $informacionFinanciera->organizacion_id;

            DB::update(
                'update organizacions set(updated_at, usuario_actualizacion) 
                        = (?, ?) where id = ?',
                [
                    $info_updated,
                    $info_editor,
                    $info_org
                ]
            );

            return response()->json([
                "success" => true,
                "informacion" => $informacion
            ], 200);
        }
    }


    public function update(Request $request, InformacionFinanciera $informacionFinanciera)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_actualizacion'] = $creador;

        $informacionFinanciera->update($solicitud);

        $info_id = $informacionFinanciera->id;

        $infoFinanciera = DB::table('informacion_financieras')
            ->select(
                'informacion_financieras.*'
            )
            ->where('id', '=', $info_id)
            ->get();

        $informacion = $infoFinanciera[0];

        $info_updated = $informacionFinanciera->updated_at;
        $info_editor = $informacionFinanciera->usuario_actualizacion;
        $info_org = $informacionFinanciera->organizacion_id;

        DB::update(
            'update organizacions set(updated_at, usuario_actualizacion) 
                    = (?, ?) where id = ?',
            [
                $info_updated,
                $info_editor,
                $info_org
            ]
        );

        return response()->json([
            "success" => true,
            "informacion" => $informacion
        ], 200);
    }

    public function destroyOperaciones(Request $request)
    {
        $organizacion_id = $request->input('organizacion_id');

        $organizacion_busqueda = DB::table('importaciones')
            ->where('organizacion_id', '=', $organizacion_id)
            ->delete();

        $organizacion_busqueda = DB::table('exportaciones')
            ->where('organizacion_id', '=', $organizacion_id)
            ->delete();

        return response()->json(["success" => true], 200);
    }


    public function destroy(InformacionFinanciera $informacionFinanciera)
    {
        $informacionFinanciera->delete();

        return response()->json(["success" => true], 200);
    }
}
