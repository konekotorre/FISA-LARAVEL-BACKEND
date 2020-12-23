<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\DetalleCategoriaContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleCategoriaContactoController extends Controller
{
    public function store(Request $request)
    {
        $cont_id = $request->contacto_id;

        $key = $request->categorias;
        $count = count($key);

        for ($i = 0; $i < $count; $i++) {
            $categoria['contacto_id'] = $cont_id;
            $categoria['subcategoria_id'] = $key[$i];

            DetalleCategoriaContacto::create($categoria);
        }
        return response()->json(["success" => true], 200);
    }
}
