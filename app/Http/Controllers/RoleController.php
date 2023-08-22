<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    function createrole(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $checkrole = Role::find($role->id);

        if ($checkrole)
            return response()->json($role);
        else
            return response()->json(null);
    }

    function readarole(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $role = Role::find($request->id);

        if ($role)
            return response()->json($role);
        else
            return response()->json(null);
    }

    function readroles()
    {
        $roles = Role::all();

        if ($roles)
            return response()->json($roles);
        else
            return response()->json(null);
    }

    function updaterole(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $checkrole = Role::find($request->id);

        if ($checkrole) {
            $checkrole->name = $request->name;
            $checkrole->save();

            return response()->json($checkrole);
        } else
            return response()->json(null);
    }

    function deleterole(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $checkdelete = Role::find($request->id);

        if ($checkdelete) {
            $deletedrole = $checkdelete;
            $checkdelete->delete();

            return response()->json($deletedrole);
        } else
            return response()->json(null);
    }

    function getuserrole(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $userid = $request->id;
        $checkuser = User::find($userid);

        if ($checkuser) {
            $user = User::join('roles', 'users.roleid', 'roles.id')
                ->select('users.name', 'roles.name')
                ->where('users.id', $userid);

            return response()->json($user);
        }
        else
            return response()->json(null);
    }
}