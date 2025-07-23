<?php

namespace OGame\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use OGame\Services\PlayerService;

class AllianceController extends Controller
{
    /**
     * Shows the alliance index page
     */
    public function index(Request $request): View
{
    $playerService = app()->make(PlayerService::class, [
        'player_id' => $request->user()->id,
    ]);

    $player = $playerService->getPlayer($request->user()->id);

    return view('ingame.alliance.index', compact('player'));
}



    /**
     * Join the alliance (currently hardcoded to "The Voidborn")
     */
    public function join(Request $request)
    {
        $user = auth()->user();

        // Hardcoded faction ID (can be dynamic later)
        $factionId = $request->input('alliance_id', 1);

        $user->alliance_id = $factionId;
        $user->save();

        return redirect()->back()->with('status', 'You have successfully joined The Voidborn!');
    }

    /**
     * Load create/join alliance UI via AJAX
     */
    public function ajaxCreate(): JsonResponse
    {
        return response()->json([
            'content' => [
                'alliance/alliance_create' => view('ingame.alliance.join')->render(), // or 'create' if that's your file
            ],
            'files' => [],
            'newAjaxToken' => csrf_token(),
            'page' => [
                'stateObj' => [],
                'title' => 'Join Faction',
                'url' => route('alliance.index'),
            ],
            'serverTime' => time(),
            'target' => 'alliance/alliance_create',
        ]);
    }
}