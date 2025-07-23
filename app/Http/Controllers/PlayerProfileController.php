<?php

namespace OGame\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OGame\Http\Controllers\Controller;

class PlayerProfileController extends Controller
{
    public function index()
    {
        $player = Auth::user();

        $avatars = [
            ['id' => 1, 'name' => 'Cyber Soldier', 'image' => 'img/avatars/cyber1.png'],
            ['id' => 2, 'name' => 'Neon Mage', 'image' => 'img/avatars/neon2.png'],
            ['id' => 3, 'name' => 'Synth Ninja', 'image' => 'img/avatars/ninja3.png'],
        ];

        return view('profile.index', compact('player', 'avatars'));
    }

    // ✅ Make sure this is still inside the class
    public function selectAvatar(Request $request)
{
    $request->validate([
        'avatar' => 'required|string',
    ]);

    $user = Auth::user();
    $user->avatar = $request->input('avatar');
    $user->save();

    return response()->json(['message' => 'Avatar updated successfully.']);
}
    public function setAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
        ]);

        $user = Auth::user();
        $user->avatar = $request->input('avatar');
        $user->save();

        

        return response()->json(['success' => true]);
    }
}