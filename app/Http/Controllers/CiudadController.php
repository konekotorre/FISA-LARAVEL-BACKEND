<?php

namespace App\Http\Controllers;

use Validator;
use App\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiudadController extends Controller
{
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

        return response()->json([ "success" => true, 'ciudades' => $ciudades_busqueda], 200);
    }

    
    public function store(Request $request)
    {
        $solicitud = $request->all();

        Ciudad::create($solicitud);

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Ciudad $ciudad)
    {
        $ciudad_id = $ciudad->id;

        $ciudades_busqueda = DB::table('ciudads')
            ->select(
                'ciudads.*'
            )
            ->where('ciudads.id', '=', $ciudad_id)
            ->get();

        return response()->json([
            "success" => true,
            "ciudad" => $ciudades_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Ciudad $ciudad)
    {
        $ciudad->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Ciudad $ciudad)
    {
        $ciudad->delete();

        return response()->json(["success" => true], 200);
    }
}
