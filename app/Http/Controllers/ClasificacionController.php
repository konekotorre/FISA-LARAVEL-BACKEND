<?php

namespace App\Http\Controllers;

use App\Clasificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ClasificacionController extends Controller
{
    public function store(Request $request)
    {
        Clasificacion::create($request->all());
        return response()->json([
            "success" => true
        ], 200);
    }


    public function show(Clasificacion $clasificacion)
    {
        $clasificacion = DB::table('clasificacions')
            ->select(
                'clasificacions.*'
            )
            ->where('clasificacions.id', '=', $clasificacion->id)
            ->get();
        return response()->json([
            "success" => true,
            "clasificacion" => $clasificacion[0]
        ], 200);
    }


    public function update(Request $request, Clasificacion $clasificacion)
    {
        $clasificacion->update($request->all());
        return response()->json(["success" => true], 200);
    }


    public function destroy(Clasificacion $clasificacion)
    {
        $clasificacion->delete();
        return response()->json(["success" => true], 200);
    }
}
