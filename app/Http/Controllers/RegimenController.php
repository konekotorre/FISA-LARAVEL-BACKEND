<?php

namespace App\Http\Controllers;

use Validator;
use App\Regimen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegimenController extends Controller
{
    public function store(Request $request)
    {
        Regimen::create($request->all());
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Regimen $regimen)
    {
        $regimen_busqueda = DB::table('regimens')
            ->select(
                'regimens.*'
            )
            ->where('regimens.id', '=', $regimen->id)
            ->get();
        return response()->json([
            "success" => true,
            "regimen" => $regimen_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Regimen $regimen)
    {
        $regimen->update($request->all());
        return response()->json(["success" =>  true], 200);
    }


    public function destroy(Regimen $regimen)
    {
        $regimen->delete();
        return response()->json(["success" => true], 200);
    }
}
