<?php

namespace App\Http\Controllers;

use App\User;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index()
    {
        $users = DB::table('users')
            ->join('tipo_documento_personas', 'tipo_documento_personas.id', '=', 'users.tipo_documento_persona_id')
            ->select(
                'user.id',
                'users.nombres',
                'users.apellidos',
                'tipo_documento_personas.nombre as documento',
                'users.numero_documento',
                'user.usuario',
            )
            ->orderBy('users.updated_at')
            ->get();

        return response()->json([
            "success" => true,
            "usuarios" => $users
        ], 200);
    }


    public function indexRoles()
    {
        return response()->json([
            "success" => true,
            "roles" => Role::all()
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();
        $solicitud['password'] = bcrypt($solicitud['password']);
        $rol = $solicitud['rol'];

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];
        $solicitud['usuario_creacion'] = $creador;
        $solicitud['usuario_actualizacion'] = $creador;

        $user = User::create($solicitud);

        if ($rol == 1) {
            $role = Role::find(1);
            $user->assignRole($role);
        } elseif ($rol == 2) {
            $role = Role::find(2);
            $user->assignRole($role);
        } else {
            return response()->json(["success" => false], 200);
        }

        $user_id = $user->id;

        return response()->json([
            "success" => true,
            "usuario" => $user_id,
        ], 200);
    }


    public function show(User $user)
    {
        $user_id = $user->id;

        $user = DB::table('users')
            ->join('tipo_documento_personas', 'tipo_documento_personas.id', '=', 'users.tipo_documento_persona_id')
            ->select(
                'users.*'
            )
            ->where('users.id', '=', $user_id)
            ->get();

        $creador_busqueda = DB::table('users')
            ->join('users', 'users.id', '=', 'oficinas.usuario_creacion')
            ->select('users.usuario as creador')
            ->where('users.id', '=', $user_id)
            ->get();

        $editor_busqueda = DB::table('users')
            ->join('users', 'users.id', '=', 'oficinas.usuario_actualizacion')
            ->select('users.usuario as editor')
            ->where('users.id', '=', $user_id)
            ->get();

        return response()->json([
            "success" => true,
            "usuario" => $user[0],
            "rol" => $user->getRoleNames()[0],
            "usuario_creacion" => $creador_busqueda[0],
            "usuario_actualizacion" => $editor_busqueda[0]
        ], 200);
    }


    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return response()->json(["success" => true], 200);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(["success" => true], 200);
    }
}
