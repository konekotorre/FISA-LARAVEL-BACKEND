<?php

namespace App\Http\Controllers;

use Validator;
use App\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoriaController extends Controller
{

    public function index()
    {
        return response()->json([
            "success" => true,
            "subcategorias" => Subcategoria::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $subcategoria = Subcategoria::create($request->all());

        return response()->json([
            "success" => true,
            "subcategoria" => $subcategoria->id
        ], 200);
    }


    public function show(Subcategoria $subcategoria)
    {
        $subcat_id = $subcategoria->id;

        $subcat_busqueda = DB::table('subcategorias')
            ->select(
                'subcategorias.*'
            )
            ->where('subcategorias.id', '=', $subcat_id)
            ->get();

        return response()->json([
            "success" => true,
            "subcategoria" => $subcat_busqueda[0]
        ], 200);
    }

    public function update(Request $request, Subcategoria $subcategoria)
    {
        $subcategoria->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();

        return response()->json(["success" => true], 200);
    }
}
