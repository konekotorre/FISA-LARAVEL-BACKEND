<?php

namespace App\Http\Controllers;

use Validator;
use App\Ciiu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiiuController extends Controller
{
    public function store(Request $request)
    {
        ciiu::create($request->all());
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Ciiu $ciiu)
    {
        $ciiu_busqueda = DB::table('ciius')
            ->select(
                'ciius.*'
            )
            ->where('ciius.id', '=', $ciiu->id)
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
