<?php

namespace App\Http\Controllers;

use App\MotivoVisita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotivoVisitaController extends Controller
{
    public function store(Request $request)
    {
        MotivoVisita::create($request->all());
        return response()->json(["success" => true], 200);
    }

    public function show(MotivoVisita $motivoVisita)
    {
        $motivo_busqueda = DB::table('estado_visitas')
            ->select(
                'estado_visitas.*'
            )
            ->where('estado_visitas.id', '=', $motivoVisita->id)
            ->get();
        return response()->json([
            "success" => true,
            "estado" => $motivo_busqueda[0]
        ], 200);
    }

    public function update(Request $request, MotivoVisita $motivoVisita)
    {
        $motivoVisita->update($request->all());
        return response()->json(["success" => true], 200);
    }

    public function destroy(MotivoVisita $motivoVisita)
    {
        $motivoVisita->delete();
        return response()->json(["success" => true], 200);
    }
}
