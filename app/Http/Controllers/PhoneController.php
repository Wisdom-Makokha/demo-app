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

        if ($checkphone)
            return response([
                'requestdata' => $checkphone
            ], 200);
        else
            return response([
                'message' => 'phonenumber not added'
            ], 500);
    }

    function readallphones()
    {
        $phones = phone::all();

        if ($phones)
            return response([
                'requestdata' => $phones
            ], 200);
        else
            return response([
                'message' => 'no phonenumbers found'
            ], 404);
    }

    function readaphone(Request $request)
    {
        $phonenumber = $request->input(key: 'phonenumber');

        $phone = phone::select('phones.phonenumber, phones.userid')
            ->where('phones.phonenumber', $phonenumber)
            ->get();

        if ($phone)
            return response([
                'requestdata' => $phone
            ], 200);
        else
            return response([
                'message' => 'no such phonenumber found'
            ], 404);
    }

    function deletephone(Request $request)
    {
        $phonenumber = $request->input(key: 'phonenumber');

        $phone = phone::select('phones.*')
            ->where('phones.phonenumber', $phonenumber)
            ->get();

        if ($phone) {
            $deletedphone = $phone;
            $phone->delete();

            return response([
                'requestdata' => $deletedphone
            ], 200);
        } else
            return response([
                'message' => 'no such phonenumber found'
            ], 404);
    }
}