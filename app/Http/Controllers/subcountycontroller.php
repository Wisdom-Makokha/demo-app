<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\subcounty;
use Illuminate\Http\Request;

class subcountycontroller extends Controller
{
    //
    function createsubcounty(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $subcounties = subcounty::create([
            'name' => $request->name
        ]);

        $subcountiescheck = subcounty::find($subcounties->id);

        if($subcountiescheck){
            return response()->json($subcountiescheck);
        }
        else{
            return response()->json(null);
        }
    }

    function readallsubcounty(){
        $subcounty = subcounty::get();

        if($subcounty){
            return response()->json($subcounty);
        }
        else{
            return response(null);
        }
    }

    function readasubcounty(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $subcounty = subcounty::find($request->id);

        if($subcounty){
            return response()->json($subcounty);
        }
        else{
            return response()->json(null);
        }
    }

    function updatesubcounty(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $subcounty = subcounty::find($request->id);

        if($subcounty){
            $subcounty->name = $request->name;

            $subcounty->save();
            return response()->json($subcounty);
        }
        else{
            return response()->json(null);
        }
    }

    function deletesubcounty(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $subcounty = subcounty::find($request->id);

        if($subcounty){
            $deletedsubcounty = $subcounty;

            $subcounty->delete();
            return response()->json($deletedsubcounty);
        }
        else{
            return response()->json(null);
        }
    }

    function getusers(){
        $users = User::join('subcounty', 'users.subcountyid', 'subcounty.id')
        ->select('users.*', 'subcounty.name as subcountyname')
        ->get();
        return $users;
    }

    function getuser(Request $request){
        $id = $request->input(key: 'id');
        $name = $request->input(key: 'name');

        return User::join('subcounty', 'users.subcountyid', 'subcounty.id')
        ->select('users.*', 'subcounty.name as subcountyname')
        ->where('users.id', $id)->where('users.name', $name)
        ->get();
    }

    function getsubcountyname(Request $request){
        $id = $request->input(key: 'id');

        return User::find($id)->subcounty->name;
    }

    function getusersubcounty(Request $request){
        $userid = $request->input(key: 'id');

        return User::find($userid)->town->subcounty->name;
    }
}
