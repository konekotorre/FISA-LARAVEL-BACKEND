<?php

namespace App\Http\Controllers;

use App\EstadoVisita;
use Illuminate\Http\Request;

class EstadoVisitaController extends Controller
{

    public function index()
    {
        return response()->json([
            "success" => true,
            "estados" => EstadoVisita::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $estadoVisita = EstadoVisita::create($request->all());

        return response()->json(["success" => true], 200);
    }

    public function show(EstadoVisita $estadoVisita)
    {
        $estado_id = $estadoVisita->id;

        $estado_busqueda = DB::table('estado_visitas')
            ->select(
                '*'
            )
            ->where('estado_visitas.id', '=', $estado_id)
            ->get();

        return response()->json([
            "success" => true,
            "estado" => $estado_busqueda[0]
        ], 200);
    }

    public function update(Request $request, EstadoVisita $estadoVisita)
    {
        $estadoVisita->update($request->all());

        return response()->json(["success" => true], 200);
    }

    public function destroy(EstadoVisita $estadoVisita)
    {
        $estadoVisita->delete();

        return response()->json(["success" => true], 200);
    }
}
