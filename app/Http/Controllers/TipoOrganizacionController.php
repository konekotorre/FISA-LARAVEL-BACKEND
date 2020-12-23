<?php

namespace App\Http\Controllers;

use Validator;
use App\TipoOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoOrganizacionController extends Controller
{

    public function index()
    {
        $tipo_busqueda = DB::table('tipo_organizacions')
            ->select(
                'tipo_organizacions.id',
                'tipo_organizacions.nombre',
                'tipo_organizacions.descripcion'
            )
            ->orderBy('tipo_organizacions.nombre')
            ->get();

        return response()->json($tipo_busqueda);
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

        $tipoOrganizacionOrganizacion = TipoOrganizacion::create($request->all());

        return response()->json($tipoOrganizacionOrganizacion, 201);
    }


    public function show(TipoOrganizacion $tipoOrganizacion)
    {
        $tipo_id = $tipoOrganizacion->id;

        $tipo_busqueda = DB::table('tipo_organizacions')
            ->select(
                'tipo_organizacions.id',
                'tipo_organizacions.nombre',
                'tipo_organizacions.descripcion'
            )
            ->where('tipo_organizacions.id', '=', $tipo_id)
            ->get();

        return response()->json($tipo_busqueda);
    }


    public function update(Request $request, $tipoOrganizacion)
    {
        $tipoOrganizacion->update($request->all());

        return response()->json($tipoOrganizacion, 200);
    }


    public function destroy(TipoOrganizacion $tipoOrganizacion)
    {
        $tipoOrganizacion->delete();

        return response()->json(null, 204);
    }
}
