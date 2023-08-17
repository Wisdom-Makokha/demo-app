<?php

namespace App\Http\Controllers;

use App\Models\phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    //
    function createphone(Request $request)
    {
        $request->validate([
            'phonenumber' => 'required',
            'userid' => 'required'
        ]);

        $phone = phone::create([
            'phonenumber' => $request->phonenumber,
            'userid' => $request->userid
        ]);

        $checkphone = phone::find($phone->id);

        if($checkphone)
            return response()->json($phone);
        else
            return response()->json(null);
    }

    function readallphones()
    {
        $phones = phone::all();

        if($phones)
            return response()->json($phones);
        else
            return response()->json(null);
    }

    function readaphone(Request $request)
    {
        
        $phonenumber = $request->input(key: 'phonenumber');

        $phone = phone::select('phones.phonenumber, phones.userid')
        ->where('phones.phonenumber', $phonenumber)
        ->get();

        if($phone)
            return response()->json($phone);
        else
            return response()->json(null);
    }

    function deletephone(Request $request)
    {
        $phonenumber = $request->input(key: 'phonenumber');

        $phone = phone::select('phones.*')
        ->where('phones.phonenumber', $phonenumber)
        ->get();

        if($phone)
        {
            $deletedphone = $phone;
            $phone->delete();

            return response()->json($phone);
        }
        else
            return response()->json(null);
    }
}
