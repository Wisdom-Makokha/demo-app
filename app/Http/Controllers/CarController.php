<?php

namespace App\Http\Controllers;

use App\Models\car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    //
    function createcar (Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $newcar = car::create([
            'name' => $request->name
        ]);

        $checknewcar = car::find($newcar->id);

        if($checknewcar)
        {
            return response()->json($newcar);
        }
        else
            return response("Car not created");
    }
}
