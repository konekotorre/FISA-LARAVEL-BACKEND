<?php

namespace App\Http\Controllers;

use Validator;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{

    public function index()
    {
        $sector_busqueda = DB::table('sectors')
            ->select(
                'sectors.id',
                'sectors.nombre',
                'sectors.descripcion'
            )
            ->orderBy('sectors.nombre')
            ->get();

        return response()->json($sector_busqueda);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $sector = Sector::create($request->all());

        return response()->json($sector, 201);
    }


    public function show(Sector $sector)
    {
        $sector_id = $sector->id;

        $sector_busqueda = DB::table('sectors')
            ->select(
                'sectors.id',
                'sectors.nombre',
                'sectors.descripcion'
            )
            ->where('sectors.id', '=', $sector_id)
            ->get();

        return response()->json($sector_busqueda);
    }


    public function update(Request $request, Sector $sector)
    {
        $sector->update($request->all());

        return response()->json($sector, 200);
    }


    public function destroy(Sector $sector)
    {
        $sector->delete();

        return response()->json(true, 204);
    }
}
