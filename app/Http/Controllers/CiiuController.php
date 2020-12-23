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
        $ciiu_busqueda = DB::table('ciius')
            ->select(
                'ciius.nombre',
                'ciius.id',
            )
            ->get();

        return response()->json($ciiu_busqueda);
    }


    public function search(Request $request)
    {
        $tipo = $request->input('tipo');
        $palabra = $request->input('palabra');

        if ($tipo == "nombre") {

            $nombre = '%' . $palabra . '%';

            $ciiu_busqueda = DB::table('ciius')
                ->select(
                    'ciius.nombre',
                    'ciius.id',
                )
                ->where('ciius.nombre', 'ilike', $nombre)
                ->get();

            return response()->json($ciiu_busqueda);
        } else if ($tipo == "codigo") {

            $ciiu_busqueda = DB::table('ciius')
                ->select(
                    'ciius.nombre',
                    'ciius.codigo',
                )
                ->orWhere('ciius.codigo', '=', $palabra)
                ->get();

            return response()->json($ciiu_busqueda);
        } else {
            return response()->json(null, 204);
        }
    }

    public function store(Request $request)
    {
        $solicitud = $request->all();

        $validator = Validator::make($solicitud, [
            'nombre' => 'required',
            'codigo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'mensaje' => 'Ha ingresado algun dato incorrecto o se ha presentado algun error'
            ], 422);
        }

        $ciiu = ciiu::create($request->all());

        return response()->json($ciiu, 201);
    }


    public function show(Ciiu $ciiu)
    {
        $ciiu_codigo = $ciiu->codigo;

        $ciiu_busqueda = DB::table('ciius')
            ->select(
                'ciius.nombre',
                'ciius.codigo',
            )
            ->where('ciius.codigo', '=', $ciiu_id)
            ->get();

        return response()->json($ciiu_busqueda);
    }

    public function update(Request $request, Ciiu $ciiu)
    {
        $ciiu->update($request->all());

        return response()->json($ciiu, 200);
    }


    public function destroy(Ciiu $ciiu)
    {
        $ciiu->delete();

        return response()->json(true, 204);
    }
}
