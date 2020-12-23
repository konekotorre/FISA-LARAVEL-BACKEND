<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
                'user.usuario',
                'tipo_documento_personas.nombre as documento',
                'users.numero_documento',
            )
            ->orderBy('usuario')
            ->get();

        return response()->json($users, 200);
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
            return response()->json(false, 404);
        }

        $user_id = $user->id;

        $user = DB::table('users')
            ->join('tipo_documento_personas', 'tipo_documento_personas.id', '=', 'users.tipo_documento_persona_id')
            ->select(
                'users.id',
                'users.nombres',
                'users.apellidos',
                'tipo_documento_personas.nombre',
                'users.numero_documento',
                'users.usuario',
                'users.email',
                'users.estado',
                'users.created_at as fecha_creacion',
                'users.updated_at as fecha_actualizacion'
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



        return response()->json([$user, $user->getRoleNames(), $creador_busqueda, $editor_busqueda], 201);
    }


    public function show(User $user)
    {
        $user_id = $user->id;

        $user = DB::table('users')
            ->join('tipo_documento_personas', 'tipo_documento_personas.id', '=', 'users.tipo_documento_persona_id')
            ->select(
                'users.id',
                'users.nombres',
                'users.apellidos',
                'tipo_documento_personas.nombre',
                'users.numero_documento',
                'users.usuario',
                'users.email',
                'users.estado',
                'users.created_at as fecha_creacion',
                'users.updated_at as fecha_actualizacion'
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

        return response()->json([$user, $user->getRoleNames(), $creador_busqueda, $editor_busqueda], 201);
    }


    public function update(Request $request, $user)
    {
        $user->update($request->all());

        $user_id = $user->id;

        $user = DB::table('users')
            ->join('tipo_documento_personas', 'tipo_documento_personas.id', '=', 'users.tipo_documento_persona_id')
            ->select(
                'users.id',
                'users.nombres',
                'users.apellidos',
                'tipo_documento_personas.nombre',
                'users.numero_documento',
                'users.usuario',
                'users.email',
                'users.estado',
                'users.created_at as fecha_creacion',
                'users.updated_at as fecha_actualizacion'
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


        return response()->json([$user, $user->getRoleNames(), $creador_busqueda, $editor_busqueda], 200);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(true, 204);
    }
}
