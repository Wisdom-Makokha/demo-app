<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    function createuser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'townid' => 'required|exists:towns,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'townid' => $request->townid
        ]);

        $checkuser = User::find($user->id);

        if ($checkuser) {
            $token = $user->createToken('usertoken')->plainTextToken;

            return response([
                'token' => $token
            ], 201);
        } else
            return response([
                'message' => 'user not created'
            ], 500);
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

        if ($user)
            return response([
                'requestdata' => $user
            ], 200);
        else
            return response([
                'message' => 'no such user found',
            ], 404);
    }

    function readallusers()
    {
        $users = User::get();

        if ($users)
            return response([
                'requestdata' => $users
            ], 200);
        else
            return response([
                'message' => 'no users found'
            ], 404);
    }

    function updateuser(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'email' => 'required|string|email|unique',
            'password' => 'required|string|confirmed',
            'townid' => 'required|integer|exists:towns,id'
        ]);

        $user = User::find($request->input(key: 'id'));

        if ($user) {
            $user->name = $request->input(key: 'name');
            $user->email = $request->input(key: 'email');
            $user->password = $request->input(key: 'password');
            $user->townid = $request->input(key: 'townid');
            $user->save();

            return response([
                'reqeustdata' => $user
            ], 200);
        } else
            return response([
                'message' => 'no such user found',
            ], 404);
    }

    function deleteuser(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $userid = $request->input(key: 'id');

        $user = User::find($userid);

        if ($user) {
            $deleteduser = $user;
            $phones = User::find($userid)->phone;

            $user->delete();
            $phones->delete();

            return response([
                'requestdata' => $deleteduser
            ], 200);
        } else
            return response([
                'message' => 'user not found'
            ], 404);
    }

    function getuserphonetown()
    {
        $users = User::join('phones', 'users.id', 'phones.userid')
            ->join('towns', 'towns.id', 'users.townid')
            ->select('users.id', 'users.name as username', 'users.email', 'phones.phonenumber', 'towns.name as town')
            ->get();

        if ($users)
            return response([
                'requestdata' => $users
            ], 200);
        else
            return response([
                'message' => 'data not found'
            ], 404);
    }

    function userlogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);

        $username = $request->name;
        $password = $request->password;

        $user = User::where('name', $username)->first();

        if (!$user || !Hash::check($password, $user->password))
            return response(['message' => 'Bad credentials'], 401);
        else {
            $token = $user->createToken('usertoken')->plainTextToken;

            $response = [
                'requestdata' => $user->id,
                'token' => $token
            ];

            return response($response, 201);
        }
    }

    function userlogout(){
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Logged out'
        ], 202);
    }
}