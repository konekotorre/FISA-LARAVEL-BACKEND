<?php

namespace App\Http\Controllers;

use Validator;
use App\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{

    public function store(Request $request)
    {
        Pais::create($request->all());

        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Pais $pais)
    {
        $pais_id = $pais->id;

        $pais_busqueda = DB::table('pais')
            ->select(
                'pais.*',
            )
            ->where('pais.id', '=', $pais_id)
            ->get();

        return response()->json([
            "success" => true,
            "pais" => $pais_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Pais $pais)
    {
        $pais->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Pais $pais)
    {
        $pais->delete();

        return response()->json(["success" => true], 200);
    }
}
