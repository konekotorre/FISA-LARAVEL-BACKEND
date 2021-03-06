<?php

namespace App\Http\Controllers;

use App\Sexo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SexoController extends Controller
{

    public function store(Request $request)
    {
        Sexo::create($request->all());
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(sexo $sexo)
    {
        $sexo_busqueda = DB::table('sexos')
            ->select(
                'sexos.*'
            )
            ->where('sexos.id', '=', $sexo->id)
            ->get();
        return response()->json([
            "success" => true,
            "sexo" => $sexo_busqueda[0]
        ], 200);
    }


    public function update(Request $request, sexo $sexo)
    {
        $sexo->update($request->all());
        return response()->json(["success" => true], 200);
    }


    public function destroy(sexo $sexo)
    {
        $sexo->delete();
        return response()->json(["success" => true], 200);
    }
}
