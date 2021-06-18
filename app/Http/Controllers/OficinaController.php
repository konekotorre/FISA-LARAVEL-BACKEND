<?php

namespace App\Http\Controllers;

use App\Oficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OficinaController extends Controller
{

    public function index(Request $request)
    {
        $org_id = $request->input('organizacion_id');

        $oficinas = DB::table('oficinas')
            ->leftJoin('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
            ->leftJoin('pais', 'pais.id', '=', 'oficinas.pais_id')
            ->leftJoin('tipo_oficinas', 'tipo_oficinas.id', '=', 'oficinas.tipo_oficina_id')
            ->select(
                'oficinas.id',
                'oficinas.organizacion_id',
                'oficinas.direccion',
                'oficinas.telefono_1',
                'tipo_oficinas.nombre as tipo',
                'ciudads.nombre as ciudad',
                'pais.nombre as pais'
            )
            ->where('oficinas.organizacion_id', '=', $org_id)
            ->orderBy('oficinas.updated_at')
            ->get();

        return response()->json([
            'success' => true,
            'oficinas' => $oficinas
        ], 200);
    }

    
    public function listForms()
    {
        $tipo_busqueda = DB::table('tipo_oficinas')
            ->select(
                'tipo_oficinas.id',
                'tipo_oficinas.nombre'
            )
            ->orderBy('tipo_oficinas.nombre')
            ->get();

        $pais_busqueda = DB::table('pais')
            ->select(
                'pais.id',
                'pais.nombre',
            )
            ->orderBy('pais.nombre')
            ->get();

        return response()->json([
            "success" => true,
            'tipos' => $tipo_busqueda,
            'paises' => $pais_busqueda
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];

        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

        $oficina = Oficina::create($solicitud);

        // $oficina_id = $oficina->id;

        // $office = DB::table('oficinas')
        //     ->select(
        //         'oficinas.id'
        //     )
        //     ->where('oficinas.id', '=', $oficina_id)
        //     ->get();

        return response()->json([
            'success' => true,
            //'oficina' => $$office[0],
        ], 200);
    }


    public function show(Oficina $oficina)
    {
        $oficina_id = $oficina->id;

        $office = DB::table('oficinas')
            ->select(
                'oficinas.*'
            )
            ->where('oficinas.id', '=', $oficina_id)
            ->get();

        return response()->json([
            "success" => true,
            'oficina' => $office[0]
        ], 200);
    }


    public function update(Request $request, Oficina $oficina)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador;

        $oficina->update($solicitud);

        $oficina_id = $oficina->id;

        $office = DB::table('oficinas')
            ->select(
                'oficinas.id'
            )
            ->where('oficinas.id', '=', $oficina_id)
            ->get();

        return response()->json([
            'success' => true,
            'oficina' => $office[0]
        ], 200);
    }


    public function destroy(Oficina $oficina)
    {
        $oficina->delete();

        return response()->json(["success" => true], 200);
    }
}
