<?php

namespace App\Http\Controllers;

use Validator;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{

    public function index()
    {
        return response()->json([
            "success" => true,
            "categorias" => Categoria::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $categoria = Categoria::create($request->all());

        return response()->json([
            "success" => true,
            "categoria" => $categoria->id
        ], 200);
    }


    public function show(Categoria $categoria)
    {
        $cat_id = $categoria->id;

        $categoria_busqueda = DB::table('categorias')
            ->select(
                'categorias.*'
            )
            ->where('categorias.id', '=', $cat_id)
            ->get();

        return response()->json([
            "success" => true,
            "categoria" => $categoria_busqueda[0]
        ], 200);
    }


    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json(["success" => true], 200);
    }
}
