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
        $clasificaciones = DB::table('clasificacions')
            ->select(
                'clasificacions.id',
                'clasificacions.nombre',
                'clasificacions.cuota_anual',
                'clasificacions.temporada_cuota'
            )
            ->orderBy('clasificacions.nombre')
            ->get();

        return response()->json(["clasificaciones" => $clasificaciones], 200);
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

        $clasificacion = Clasificacion::create($solicitud);

        return response()->json(["clasificacion" => $clasificacion], 201);
    }


    public function show(Clasificacion $clasificacion)
    {
        $clasi_id = $clasificacion->id;

        $clasificacion = DB::table('clasificacions')
            ->select(
                'clasificacions.id',
                'clasificacions.nombre',
                'clasificacions.cuota_anual',
                'clasificacions.temporada_cuota'
            )
            ->where('clasificacions.id', '=', $clasi_id)
            ->get();

        return response()->json(["clasificacion" => $clasificacion], 200);
    }


    public function update(Request $request, Clasificacion $clasificacion)
    {
        $clasificacion->update($request->all());

        return response()->json(["clasificacion" => $clasificacion], 200);
    }


    public function destroy(Clasificacion $clasificacion)
    {
        $clasificacion->delete();

        return response()->json(true, 204);
    }
}
