<?php

namespace App\Http\Controllers;

// use App\Role;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        return response()->json(Role::all());
    }


    public function show(Role $role)
    {
        return response()->json($role);
    }
}
