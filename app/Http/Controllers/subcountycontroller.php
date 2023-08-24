<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\subcounty;
use Illuminate\Http\Request;

class subcountycontroller extends Controller
{
    //
    function createsubcounty(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $subcounties = subcounty::create([
            'name' => $request->name
        ]);

        $subcountiescheck = subcounty::find($subcounties->id);

        if ($subcountiescheck)
            return response([
                'requestdata' => $subcountiescheck
            ], 201);
        else
            return response([
                'message' => 'subcounty not created'
            ], 500);
    }

    function readallsubcounty()
    {
        $subcounty = subcounty::get();

        if ($subcounty)
            return response([
                'requestdata' => $subcounty
            ]);
        else
            return response([
                'message' => 'no subcounties found'
            ], 404);
    }

    function readasubcounty(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $subcountyid = $request->input(key: 'id');

        $subcounty = subcounty::find($subcountyid);

        if ($subcounty)
            return response([
                'requestdata' => $subcounty
            ], 200);
        else
            return response([
                'message' => 'no such subcounty found'
            ], 404);
    }

    function updatesubcounty(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $subcounty = subcounty::find($request->input(key: 'id'));

        if ($subcounty) {
            $subcounty->name = $request->name;

            $subcounty->save();
            return response([
                'requestdata' => $subcounty
            ], 200);
        } else
            return response([
                'message' => 'no such subcounty found'
            ], 404);
    }

    function deletesubcounty(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $subcounty = subcounty::find($request->input(key: 'id'));

        if ($subcounty) {
            $deletedsubcounty = $subcounty;

            $subcounty->delete();
            return response([
                'requestdata' => $deletedsubcounty
            ], 200);
        } else
            return response([
                'message' => 'no such subcounty found'
            ], 404);
    }

    function getusers()
    {
        $users = User::join('subcounty', 'users.subcountyid', 'subcounty.id')
            ->select('users.*', 'subcounty.name as subcountyname')
            ->get();
        return $users;
    }

    function getuser(Request $request)
    {
        $id = $request->input(key: 'id');
        $name = $request->input(key: 'name');

        return User::join('subcounty', 'users.subcountyid', 'subcounty.id')
            ->select('users.*', 'subcounty.name as subcountyname')
            ->where('users.id', $id)->where('users.name', $name)
            ->get();
    }

    function getsubcountyname(Request $request)
    {
        $id = $request->input(key: 'id');

        return User::find($id)->subcounty->name;
    }

    function getusersubcounty(Request $request)
    {
        $userid = $request->input(key: 'id');

        return User::find($userid)->town->subcounty->name;
    }
}