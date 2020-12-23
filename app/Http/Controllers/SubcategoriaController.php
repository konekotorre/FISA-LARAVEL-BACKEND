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
        $subcat_busqueda = DB::table('subcategorias')
            ->select(
                'subcategorias.id',
                'subcategorias.nombre',
                'subcategorias.descripcion'
            )
            ->orderBy('subcategorias.nombre')
            ->get();

        return response()->json($subcat_busqueda);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $subcategoria = Subcategoria::create($request->all());

        return response()->json($subcategoria, 201);
    }


    public function show(Subcategoria $subcategoria)
    {
        $subcat_id = $subcategoria->id;

        $subcat_busqueda = DB::table('subcategorias')
            ->select(
                'subcategorias.id',
                'subcategorias.nombre',
                'subcategorias.descripcion'
            )
            ->where('subcategorias.id', '=', $subcat_id)
            ->get();

        return response()->json($subcat_busqueda);
    }

    public function update(Request $request, Subcategoria $subcategoria)
    {
        $subcategoria->update($request->all());

        return response()->json($subcategoria, 200);
    }


    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();

        return response()->json(true, 204);
    }

}
