<?php

namespace App\Http\Controllers;

use App\Exports\InfoFinancieraExport;
use App\Exports\InfoFinBusquedaExport;
use App\Exports\InfoFinGenExport;
use App\InformacionFinanciera;
use App\Clasificacion;
use App\Regimen;
use App\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class InformacionFinancieraController extends Controller
{

    public function show(Request $request)
    {
        $infoFinanciera_busqueda = DB::table('informacion_financieras')
            ->leftJoin('clasificacions', 'clasificacions.id', '=', 'informacion_financieras.clasificacion_id')
            ->select(
                'informacion_financieras.*',
            )
            ->where('informacion_financieras.organizacion_id', '=', $request->organizacion_id)
            ->get();
        if (empty($infoFinanciera_busqueda[0])) {
            return response()->json(["success" => false], 200);
        } else {
            $creador_busqueda = DB::table('informacion_financieras')
                ->leftJoin('users', 'users.id', '=', 'informacion_financieras.usuario_creacion')
                ->select('users.usuario as creador')
                ->where('informacion_financieras.organizacion_id', '=', $request->organizacion_id)
                ->get();
            $editor_busqueda = DB::table('informacion_financieras')
                ->leftJoin('users', 'users.id', '=', 'informacion_financieras.usuario_actualizacion')
                ->select('users.usuario as editor')
                ->where('informacion_financieras.organizacion_id', '=', $request->organizacion_id)
                ->get();
            $usuario_actualizacion = $editor_busqueda[0];
            $importaciones_busqueda = DB::table('importaciones')
                ->select('pais_id')
                ->where('organizacion_id', '=', $request->organizacion_id)
                ->get();
            $exportaciones_busqueda = DB::table('exportaciones')
                ->select('pais_id')
                ->where('organizacion_id', '=', $request->organizacion_id)
                ->get();
            $importaciones = $importaciones_busqueda->pluck('pais_id');
            $exportaciones = $exportaciones_busqueda->pluck('pais_id');
            return response()->json([
                "success" => true,
                "informacion" => $infoFinanciera_busqueda[0],
                "importaciones" => $importaciones,
                "exportaciones" => exportaciones,
                "usuario_creacion" => $creador_busqueda[0],
                "usuario_actualizacion" => $editor_busqueda[0]
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
        return response()->json([
            "success" => true,
            "clasificaciones" => Clasificacion::orderBy('nombre')->get(),
            "regimenes" => Regimen::orderBy('nombre')->get(),
            "paises" => Pais::orderBy('nombre')->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $solicitud = $request->all();
        $organizacion_validate = DB::table('informacion_financieras')
            ->select(
                'id'
            )
            ->where('organizacion_id', '=', $solicitud['organizacion_id'])
            ->first();
        if (empty($organizacion_validate)) {
            $creador_auth = Auth::user();
            $solicitud['usuario_creacion'] = $creador_auth['id'];
            $solicitud['usuario_actualizacion'] = $creador_auth['id'];
            $informacionFinanciera = InformacionFinanciera::create($solicitud);
            $infoFinanciera = DB::table('informacion_financieras')
                ->select(
                    'informacion_financieras.*'
                )
                ->where('id', '=', $informacionFinanciera->id)
                ->get();
            DB::update(
                'update organizacions set(updated_at, usuario_actualizacion) 
                        = (?, ?) where id = ?',
                [
                    $informacionFinanciera->updated_at,
                    $informacionFinanciera->usuario_actualizacion,
                    $informacionFinanciera->organizacion_id
                ]
            );
            return response()->json([
                "success" => true,
                "informacion" => $infoFinanciera[0]
            ], 200);
        }
    }


    public function update(Request $request, InformacionFinanciera $informacionFinanciera)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        $informacionFinanciera->update($solicitud);
        $infoFinanciera = DB::table('informacion_financieras')
            ->select(
                'informacion_financieras.*'
            )
            ->where('id', '=', $informacionFinanciera->id)
            ->get();
        DB::update(
            'update organizacions set(updated_at, usuario_actualizacion) 
                    = (?, ?) where id = ?',
            [
                $informacionFinanciera->updated_at,
                $informacionFinanciera->usuario_actualizacion,
                $informacionFinanciera->organizacion_id
            ]
        );
        return response()->json([
            "success" => true,
            "informacion" => $infoFinanciera[0]
        ], 200);
    }

    public function destroyOperaciones(Request $request)
    {
        DB::table('importaciones')
            ->where('organizacion_id', '=', $request->organizacion_id)
            ->delete();
        DB::table('exportaciones')
            ->where('organizacion_id', '=', $request->organizacion_id)
            ->delete();
        return response()->json(["success" => true], 200);
    }


    public function destroy(InformacionFinanciera $informacionFinanciera)
    {
        $informacionFinanciera->delete();
        return response()->json(["success" => true], 200);
    }
}
