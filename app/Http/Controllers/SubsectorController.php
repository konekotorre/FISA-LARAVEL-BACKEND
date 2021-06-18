<?php

namespace App\Http\Controllers;

use Validator;
use App\Subsector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubsectorController extends Controller
{
    public function indexBySector(Request $request)
    {
        $subsector_busqueda = DB::table('subsectors')
            ->select(
                'subsectors.id',
                'subsectors.nombre'
            )
            ->where('subsectors.sector_id', '=', $request->sector_id)
            ->orderBy('subsectors.nombre')
            ->get();
        return response()->json([
            "success" => true,
            "subsectores" => $subsector_busqueda
        ], 200);
    }


    public function store(Request $request)
    {
        Subsector::create($request->all());
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Subsector $subsector)
    {
        $sector_busqueda = DB::table('subsectors')
            ->join('sectors', 'sectors.id', '=', 'subsectors.sector_id')
            ->select(
                'subsectors.*'
            )
            ->where('subsectors.id', '=', $subsector->id)
            ->get();

        return response()->json([
            "success" => true,
            "subsector" => $sector_busqueda[0]
        ], 200);
    }

    public function update(Request $request, Subsector $subsector)
    {
        $subsector->update($request->all());
        return response()->json(["success" => true], 200);
    }


    public function destroy(Subsector $subsector)
    {
        $subsector->delete();
        return response()->json(["success" => true], 200);
    }
}
