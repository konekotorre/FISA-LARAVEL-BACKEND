<?php

namespace App\Http\Controllers;

use Validator;
use App\Ciiu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiiuController extends Controller
{

    public function index()
    {
        return response()->json([
            "success" => true,
            "ciius" => Ciiu::all()
        ], 200);
    }


    public function search(Request $request)
    {
        $tipo = $request->input('tipo');
        $palabra = $request->input('palabra');

        if ($tipo == "nombre") {

            $nombre = '%' . $palabra . '%';

            $ciiu_busqueda = DB::table('ciius')
                ->select(
                    'ciius.*'
                )
                ->where('ciius.nombre', 'ilike', $nombre)
                ->get();

            return response()->json([
                "success" => true,
                "ciius" => $ciiu_busqueda[0]
            ], 200);
        } else if ($tipo == "codigo") {

            $ciiu_busqueda = DB::table('ciius')
                ->select(
                    'ciius.*'
                )
                ->orWhere('ciius.codigo', '=', $palabra)
                ->get();

            return response()->json([
                "success" => true,
                "ciius" => $ciiu_busqueda[0]
            ], 200);
        }
    }

    public function store(Request $request)
    {
        $ciiu = ciiu::create($request->all());

        return response()->json([
            "success" => true,
            "ciiu_id" => $ciiu->id
        ], 200);
    }


    public function show(Ciiu $ciiu)
    {
        $ciiu_id = $ciiu->id;

        $ciiu_busqueda = DB::table('ciius')
            ->select(
                'ciius.*'
            )
            ->where('ciius.id', '=', $ciiu_id)
            ->get();

        return response()->json([
            "success" => true,
            "ciius" => $ciiu_busqueda[0]
        ], 200);
    }

    public function update(Request $request, Ciiu $ciiu)
    {
        $ciiu->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(Ciiu $ciiu)
    {
        $ciiu->delete();

        return response()->json(["success" => true], 200);
    }
}
