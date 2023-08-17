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
            'name' => 'required',
            'subcountyid' => 'required'
        ]);

        $town = town::create([
            'name' => $request->name,
            'subcountyid' => $request->subcountyid
        ]);

        if($town)
            return response()->json($town);
        else
            return response()->json(null);
    }

    function readatown(Request $request)
    {
        $townid = $request->input(key: 'id');

        $town = town::find($townid);

        if($town)
            return response()->json($town);
        else
            return response()->json(null);
    }

    function readalltowns()
    {
        $towns = town::get(['id', 'name', 'subcountyid']);

        if($towns)
            return response()->json($towns);
        else
            return response()->json(null);
    }

    function updatetown(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);
        
        $townid = $request->input(key: 'id');

        $town = town::find($townid);

        if($town)
        {
            $town->name = $request->input(key: 'name');
            $town->save();

            return response()->json($town);
        }
        else
            return response()->json(null);
    }

    function deletetown(Request $request)
    {
        $townid = $request->input(key: 'id');

        $town = town::find($townid);

        if($town)
        {
            $deletedtown = $town;
            $town->delete();

            return response()->json($town);
        }
        else
            return response()->json(null);
    }
}
