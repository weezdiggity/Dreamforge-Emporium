<?php

namespace OGame\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PlayerSetupController extends Controller
{
    public function select(Request $request)
    {
        $user = Auth::user();

        if ($user->race) {
            return response()->json(['success' => false, 'message' => 'Race already selected.']);
        }

        $validRaces = ['human', 'ai', 'cyborg'];
        $race = $request->input('race');

        if (!in_array($race, $validRaces)) {
            return response()->json(['success' => false, 'message' => 'Invalid race.']);
        }

        $user->race = $race;
        $user->save();

        return response()->json([
            'success' => true,
            'race_display' => ucfirst($race)
        ]);
    }

    public function showOverview()
    {
        return view('ingame.overview.overview');
    }
}
    

