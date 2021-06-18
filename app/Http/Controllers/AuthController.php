<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credencials = $request->only(['usuario', 'password']);
        $validator = Validator::make($credencials, [
            'usuario' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false
            ], 422);
        }
        $token = JWTAuth::attempt($credencials);
        if ($token) {
            $user = Auth::user();
            $rol = $user->getRoleNames();
            $role = $rol[0];
            return response()
            ->json([
                'success' => true,
                'token' => $token,
                'user' => User::where('usuario', $credencials['usuario'])
                    ->get(['id', 'usuario'])->first(),
                'rol' => $role,
            ], 200)
            ->header("Access-Control-Max-Age", "86400");
        } else {
            return response()->json([
                'success' => false
            ], 422);
        }
    }

    public function refreshToken()
    {
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::refresh($token);
            return response()->json([
                'success' => true,
                'token' => $token,
            ], 200);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false
            ], 422);
        } catch (TokenBlacklistedException $ex) {
            return response()->json([
                'success' => false
            ], 422);
        }
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'success' => true
            ], 200);
        } catch (JWTException $ex) {
            return response()->json([
                'success' => false
            ], 422);
        }
    }
}
