<?php

namespace App\Http\Controllers;

use App\Models\town;
use Illuminate\Http\Request;

class TownController extends Controller
{
    //
    function createtown(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'subcountyid' => 'required|integer|exists:subcounty,id'
        ]);

        $town = town::create([
            'name' => $request->name,
            'subcountyid' => $request->subcountyid
        ]);

        if ($town)
            return response([
                'requestdata' => $town
            ], 201);
        else
            return response([
                'message' => 'town not created'
            ], 500);
    }

    function readatown(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $townid = $request->input(key: 'id');

        $town = town::find($townid);

        if ($town)
            return response([
                'requestdata' => $town
            ], 200);
        else
            return response([
                'message' => 'town not found'
            ], 404);
    }

    function readalltowns()
    {
        $towns = town::get(['id', 'name', 'subcountyid']);

        if ($towns)
            return response([
                'requestdata' => $towns
            ], 200);
        else
            return response([
                'message' => 'no towns found'
            ], 404);
    }

    function updatetown(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $townid = $request->input(key: 'id');

        $town = town::find($townid);

        if ($town) {
            $town->name = $request->input(key: 'name');
            $town->save();

            return response([
                'requestdata' => $town
            ], 200);
        } else
            return response([
                'message' => 'no such town found'
            ], 404);
    }

    function deletetown(Request $request)
    {
        $townid = $request->input(key: 'id');

        $town = town::find($townid);

        if ($town) {
            $deletedtown = $town;
            $town->delete();

            return response([
                'requestdata' => $deletedtown
            ], 200);
        } else
            return response([
                'message' => 'no such town found'
            ], 404);
    }
}