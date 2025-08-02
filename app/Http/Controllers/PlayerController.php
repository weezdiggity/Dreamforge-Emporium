<?php

namespace OGame\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        // Return a list of players, or a default player page
        return response()->json([
            'message' => 'PlayerController is working!',
        ]);
    }

    public function show($id)
    {
        // Show a single player by ID (you'll hook this up to your Player model later)
        return response()->json([
            'player_id' => $id,
            'status' => 'Player details will go here.',
        ]);
    }
}
