<?php

namespace App\Http\Controllers;

use App\Clasificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ClasificacionController extends Controller
{

    public function index()
    {

        return response()->json([
            "success" => true,
            "clasificaciones" => Clasificacion::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $clasificacion = Clasificacion::create($solicitud);

        return response()->json([
            "success" => true,
            "clasificacion" => $clasificacion->id
        ], 200);
    }


    public function show(Clasificacion $clasificacion)
    {
        $clasi_id = $clasificacion->id;

        $clasificacion = DB::table('clasificacions')
            ->select(
                'clasificacions.*'
            )
            ->where('clasificacions.id', '=', $clasi_id)
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
