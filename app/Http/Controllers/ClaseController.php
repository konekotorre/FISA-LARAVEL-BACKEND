<?php

namespace App\Http\Controllers;

use App\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaseController extends Controller
{

    public function index()
    {
        return response()->json([
            "success" => true,
            "clases" => Clase::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $clase = Clase::create($request->all());

        return response()->json(["success" => true], 200);
    }


    public function show(Clase $clase)
    {
        $clase_id = $clase->id;

        $clase_busqueda = DB::table('clases')
            ->select(
                'clases.*'
            )
            ->where('clases.id', '=', $clase_id)
            ->get();

        return response()->json([
            "success" => true,
            "clase" => $clase_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Clase $clase)
    {
        $clase->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Clase $clase)
    {
        $clase->delete();

        return response()->json(["success" => true], 200);
    }
}
