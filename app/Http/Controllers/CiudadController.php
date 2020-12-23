<?php

namespace App\Http\Controllers;

use Validator;
use App\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiudadController extends Controller
{

    public function index()
    {
        $ciudades_busqueda = DB::table('ciudads')
            ->join('departamento_estados', 'departamento_estados.id', '=', 'ciudads.departamento_estado_id')
            ->join('pais', 'pais.id', '=', 'departamento_estados.pais_id')
            ->select(
                'ciudads.id',
                'ciudads.nombre as ciudad',
                'departamento_estados.nombre as departamento_estado',
                'pais.nombre as pais'
            )
            ->get();

        return response()->json(['ciudad' => $ciudades_busqueda], 200);
    }

    public function indexByDepartamento(Request $request)
    {
        $dep_id = $request->input('departamento_estado_id');

        $ciudades_busqueda = DB::table('ciudads')
            ->select(
                'ciudads.id',
                'ciudads.nombre',
            )
            ->where('ciudads.departamento_estado_id', '=', $dep_id)
            ->get();

        return response()->json(['ciudades' => $ciudades_busqueda], 200);
    }


    public function search(Request $request)
    {
        $nombre_temp = $request->input('nombre');
        $nombre = '%' . $nombre_temp . '%';

        $ciudades_busqueda = DB::table('ciudads')
            ->join('departamento_estados', 'departamento_estados.id', '=', 'ciudads.departamento_estado_id')
            ->join('pais', 'pais.id', '=', 'departamento_estados.pais_id')
            ->select(
                'ciudads.id',
                'ciudads.nombre as ciudad',
                'departamento_estados.nombre as departamento_estado',
                'pais.nombre as pais'
            )
            ->where('ciudads.nombre', 'ilike', $nombre)
            ->get();

        return response()->json($ciudades_busqueda, 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'departamento_estado_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $ciudad = Ciudad::create($solicitud);

        return response()->json($ciudad, 201);
    }


    public function show(Ciudad $ciudad)
    {
        $ciudad_id = $ciudad->id;

        $ciudades_busqueda = DB::table('ciudads')
            ->join('departamento_estados', 'departamento_estados.id', '=', 'ciudads.departamento_estado_id')
            ->join('pais', 'pais.id', '=', 'departamento_estados.pais_id')
            ->select(
                'ciudads.id',
                'ciudads.nombre as ciudad',
                'departamento_estados.nombre as departamento_estado',
                'pais.nombre as pais'
            )
            ->where('ciudads.id', '=', $ciudad_id)
            ->get();

        return response()->json($ciudades_busqueda, 200);
    }


    public function update(Request $request, Ciudad $ciudad)
    {
        $ciudad->update($request->all());

        return response()->json($ciudad, 200);
    }


    public function destroy(Ciudad $ciudad)
    {
        $ciudad->delete();

        return response()->json(true, 204);
    }
}
