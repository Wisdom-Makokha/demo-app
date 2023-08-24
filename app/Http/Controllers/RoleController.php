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
            return response([
                'requestdata' => $checkrole
            ], 200);
        else
            return response([
                'message' => 'role not created'
            ], 500);
    }

    function readarole(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $role = Role::find($request->input(key: 'id'));

        if ($role)
            return response([
                'requestdata' => $role
            ]);
        else
            return response([
                'message' => 'no such role found'
            ], 404);
    }

    function readallroles()
    {
        $roles = Role::all();

        if ($roles)
            return response([
                'requestdata' => $roles
            ], 200);
        else
            return response([
                'message' => 'no roles found'
            ], 404);
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

            return response([
                'requestdata' => $checkrole
            ]);
        } else
            return response([
                'message' => 'no such role found'
            ], 404);
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

            return response([
                'requestdata' => $deletedrole
            ], 200);
        } else
            return response([
                'message' => 'no such rolw found'
            ]);
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

            return response([
                'requestdata' => $user
            ], 200);
        } else
            return response([
                'message' => 'no data found'
            ], 404);
    }
}