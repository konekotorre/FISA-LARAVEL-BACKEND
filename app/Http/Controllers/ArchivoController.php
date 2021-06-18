<?php

namespace App\Http\Controllers;

use App\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArchivoController extends Controller
{
    
    public function index(Request $request)
    {
        $archivos = DB::table('archivos')
            ->leftJoin('users', 'users.id', '=', 'archivos.usuario_creacion')
            ->select(
                'archivos.id',
                'archivos.nombre',
                'archivos.tipo',
                'users.usuario as usuario_creacion',
                'archivos.created_at as creacion'
            )
            ->where('archivos.organizacion_id', '=', $request->organizacion_id)
            ->orderByDesc('archivos.updated_at')
            ->get();
        return response()->json([
            "success" => true,
            "archivos" => $archivos
        ], 200);
    }


    public function upload(Request $request)
    {
        $validator = $request->validate([
            'organizacion_id' => 'required',
            'file' => 'file|required|mimes:pdf,xls,xlsx,doc,docx,jpg,jpeg,png,csv,txt|max:5120',
        ]);
        $organizacion = DB::table('organizacions')
            ->select('organizacions.razon_social')
            ->where('organizacions.id', '=', $request->organizacion_id)
            ->get();
        $razon_social = $organizacion->pluck('razon_social');
        $uploadedFile = $request->file('file');
        $nombre = $uploadedFile->getClientOriginalName();
        $tipo = $uploadedFile->getClientOriginalExtension();
        $path_temp = 'public' . '/' . $razon_social['0'] . '/' . $nombre;
        if (Storage::exists($path_temp)) {
            return response()->json(["success" => false], 404);
        } else {
            $path = $request->file('file')->storeAs($razon_social['0'], $nombre, 'public');
            $creador_auth = Auth::user();
            $upload = new Archivo();
            $upload->nombre = $nombre;
            $upload->path = $path;
            $upload->tipo = $tipo;
            $upload->organizacion_id = $request['organizacion_id'];
            $upload->usuario_creacion = $creador_auth['id'];
            $upload->save();
            return response()->json(["success" => true], 200);
        }
    }


    public function download(Archivo $archivo)
    {
        $path_busqueda = DB::table('archivos')
            ->select(
                'path',
                'nombre'
            )
            ->where('archivos.id',  '=', $archivo->id)
            ->get();
        $path = $path_busqueda->pluck('path');
        $path_real = 'public' . '/' . $path['0'];
        $nombre = $path_busqueda->pluck('nombre');
        $archivo = Storage::download($path_real, $nombre['0']);
        return $archivo;
    }


    public function destroy(Archivo $archivo)
    {
        $path_busqueda = DB::table('archivos')
            ->select(
                'path',
            )
            ->where('archivos.id',  '=', $archivo['id'])
            ->get();
        $path = $path_busqueda->pluck('path');
        Storage::delete('public' . '/' . $path['0']);
        $archivo->delete();
        return response()->json(["success" => true], 200);
    }
}
