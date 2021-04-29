<?php

namespace App\Http\Controllers;

use App\TipoDocumentoPersona;
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
                'users.id',
                'users.nombres',
                'users.apellidos',
                'tipo_documento_personas.nombre as documento',
                'users.numero_documento',
                'users.usuario',
            )
            ->orderBy('users.updated_at')
            ->get();

        return response()->json([
            "success" => true,
            "usuarios" => $users
        ], 200);
    }


    public function listForms()
    {
        return response()->json([
            "success" => true,
            "tipo_documentos" => TipoDocumentoPersona::all(),
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
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.nombres',
                'users.apellidos',
                'users.tipo_documento_persona_id',
                'users.numero_documento',
                'users.usuario',
                'model_has_roles.role_id as rol_id',
                'users.email',
                'users.estado',
                'users.usuario_creacion',
                'users.usuario_actualizacion',
                'users.created_at',
                'users.updated_at',

            )
            ->where('users.id', '=', $user_id)
            ->get();

        $id_creador = $user->pluck('usuario_creacion');
        $id_editor = $user->pluck('usuario_actualizacion');

        $creador_busqueda = DB::table('users')
            ->select('users.usuario as creador')
            ->where('users.id', '=', $id_creador)
            ->get();

        $editor_busqueda = DB::table('users')
            ->select('users.usuario as editor')
            ->where('users.id', '=', $id_editor)
            ->get();

        return response()->json([
            "success" => true,
            "usuario" => $user[0],
            "usuario_creacion" => $creador_busqueda[0],
            "usuario_actualizacion" => $editor_busqueda[0]
        ], 200);
    }


    public function update(Request $request, User $user)
    {
        $solicitud = $request->all();

        $creador_auth = Auth::user();
        $creador = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador;

        if (!empty($solicitud['password'])) {
            $solicitud['password'] = bcrypt($solicitud['password']);
        }

        $user->update($solicitud);

        $rol = $request->rol;

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

    public function changePass(Request $request)
    {
        $solicitud = $request->all();

        $num_doc = $solicitud['numero_documento'];
        $email = $solicitud['email'];

        $password = bcrypt($solicitud['password']);
        $usuario = Auth::user();
        $id = $usuario['id'];

        $confirmacion = DB::table('users')
            ->select('users.id')
            ->where('users.id', '=', $id)
            ->where('users.numero_documento', '=', $num_doc)
            ->where('users.email', '=', $email)
            ->first();

        if ($confirmacion != null) {

            DB::update(
                'update users set password = ? where id = ?',
                [
                    $password,
                    $id
                ]
            );
            return response()->json(["success" => true], 200);
        } else {
            return response()->json(["success" => false], 200);
        }
    }

    public function destroy(User $user)
    {
        // $user->delete();

        DB::table('users')
            ->where('users.id', '=', $user->id)
            ->delete();

        return response()->json(["success" => true], 200);
    }
}
