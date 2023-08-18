<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function createuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'townid' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'townid' => $request->townid
        ]);

        $checkuser = User::find($user->id);

        if($checkuser)
            return response()->json($user);
        else
            return response()->json(null);
    }

    function readauser(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $userid = $request->input(key: 'id');

        $user = User::select('users.*')
        ->where('users.id', $userid)
        ->get();

        if($user)
            return response()->json($user);
        else
            return response()->json(null);
    }

    function readallusers(){
        $users = User::get();

        if($users)
            return response()->json($users);
        else
            return response()->json(null);
    }

    function updateuser(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'townid' => 'required'
        ]);

        $user = User::find($request->input(key: 'id'));

        if($user)
        {
            $user->name = $request->input(key: 'name');
            $user->email = $request->input(key: 'email');
            $user->password = $request->input(key: 'password');
            $user->townid = $request->input(key: 'townid');
            $user->save();

            return response()->json($user);
        }
        else
            return response()->json(null);
    }

    function deleteuser(Request $request)
    {
        $userid = $request->input(key: 'id');

        $user = User::find($userid);

        if($user)
        {
            $deleteduser = $user;

            $user->delete();
            return response()->json($deleteduser);
        }
        else
            return response()->json(null);
    }

    function getuserphonetown(){
        $users = User::join('phones', 'users.id', 'phones.userid')
        ->join('towns', 'towns.id', 'users.townid')
        ->select('users.id', 'users.name as username', 'users.email', 'phones.phonenumber', 'towns.name as town')
        ->get();

        if($users)
            return response()->json($users);
        else
            return response()->json(null);
    }
}
