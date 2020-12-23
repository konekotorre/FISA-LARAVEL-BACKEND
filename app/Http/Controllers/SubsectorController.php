<?php

namespace App\Http\Controllers;

use Validator;
use App\Subsector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubsectorController extends Controller
{

    public function index()
    {
        $sector_busqueda = DB::table('subsectors')
            ->join('sectors', 'sectors.id', '=', 'subsectors.sector_id')
            ->select(
                'subsectors.id',
                'subsectors.nombre',
                'subsectors.descripcion',
                'sectors.nombre as sector'
            )
            ->orderBy('sectors.nombre')
            ->orderBy('subsectors.nombre')
            ->get();

        return response()->json($sector_busqueda);
    }


    public function indexBySector(Request $request)
    {
        $sector_id = $request->input('sector_id');

        $subsector_busqueda = DB::table('subsectors')
            ->select(
                'subsectors.id',
                'subsectors.nombre'
            )
            ->where('subsectors.sector_id', '=', $sector_id)
            ->orderBy('subsectors.nombre')
            ->get();

        return response()->json(["subsectores" => $subsector_busqueda], 200);
    }


    public function search(Request $request)
    {
        $palabra = $request->input('palabra');
        $nombre = '%' . $palabra . '%';

        $subsector_busqueda = DB::table('subsectors')
            ->join('sectors', 'sectors.id', '=', 'subsectors.sector_id')
            ->select(
                'subsectors.id',
                'subsectors.nombre as subsector',
                'sector.nombre as sector'
            )
            ->where('subsectors.nombre', 'ilike', $nombre)
            ->get();

        return response()->json($subsector_busqueda, 200);
    }

    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'sector_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $subsector = Subsector::create($request->all());

        return response()->json($subsector, 201);
    }


    public function show(Subsector $subsector)
    {
        $subsec_id = $subsector->id;

        $sector_busqueda = DB::table('subsectors')
            ->join('sectors', 'sectors.id', '=', 'subsectors.sector_id')
            ->select(
                'subsectors.id',
                'subsectors.nombre',
                'subsectors.descripcion',
                'sector.id as sector'
            )
            ->where('subsectors.id', '=', $subsec_id)
            ->get();

        return response()->json($sector_busqueda);
    }

    public function update(Request $request, $subsector)
    {
        $subsector->update($request->all());

        return response()->json($subsector, 200);
    }


    public function destroy(Subsector $subsector)
    {
        $subsector->delete();

        return response()->json(true, 204);
    }
}
