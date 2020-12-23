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
        $categoria_busqueda = DB::table('categorias')
            ->select(
                'categorias.id',
                'categorias.nombre',
                'categorias.descripcion',
                'categorias.cuota_anual',
                'categorias.temporada_cuota'
            )
            ->get();

        return response()->json($categoria_busqueda);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'cuota_anual' => 'required',
            'descripcion' => 'required',
            'temporada_cuota'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $categoria = Categoria::create($request->all());

        return response()->json($categoria, 201);
    }


    public function show(Categoria $categoria)
    {
        $cat_id = $categoria->id;

        $categoria_busqueda = DB::table('categorias')
            ->select(
                'categorias.id',
                'categorias.nombre',
                'categorias.descripcion',
                'categorias.cuota_anual',
                'categorias.temporada_cuota'
            )
            ->where('categorias.id', '=', $cat_id)
            ->get();

        return response()->json($categoria_busqueda);
    }


    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update($request->all());

        return response()->json($categoria, 200);
    }


    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json(true, 204);
    }
}
