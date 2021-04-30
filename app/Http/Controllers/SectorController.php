<?php

namespace App\Http\Controllers;

use Validator;
use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{

    public function store(Request $request)
    {
        Sector::create($request->all());

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Sector $sector)
    {
        $sector_id = $sector->id;

        $sector_busqueda = DB::table('sectors')
            ->select(
                'sectors.*'
            )
            ->where('sectors.id', '=', $sector_id)
            ->get();

        return response()->json([
            "success" => true,
            "sector" => $sector_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Sector $sector)
    {
        $sector->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Sector $sector)
    {
        $sector->delete();

        return response()->json(["success" => true], 200);
    }
}
