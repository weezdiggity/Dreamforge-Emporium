<?php

namespace OGame\Http\ViewComposers;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use OGame\Facades\AppUtil;
use OGame\Services\FleetMissionService;
use OGame\Services\HighscoreService;
use OGame\Services\MessageService;
use OGame\Services\PlayerService;
use OGame\Services\SettingsService;

/**
 * Class IngameMainComposer
 * @package OGame\Http\Composers
 *
 * Contains all preprocessor logic for parsing the ingame.layouts.main
 * blade theme file.
 */
class IngameMainComposer
{
    private Request $request;
    private PlayerService $player;
    private MessageService $messageService;
    private SettingsService $settingsService;
    private FleetMissionService $fleetMissionService;

    private HighscoreService $highscoreService;

    /**
     * IngameMainComposer constructor.
     *
     * Construct view composer and get all required data via dependency
     * injection.
     *
     * @param Request $request
     * @param PlayerService $player
     * @param MessageService $messageService
     * @param SettingsService $settingsService
     * @param FleetMissionService $fleetMissionService
     */
    public function __construct(Request $request, PlayerService $player, MessageService $messageService, SettingsService $settingsService, FleetMissionService $fleetMissionService, HighscoreService $highscoreService)
    {
        $this->request = $request;
        $this->player = $player;
        $this->messageService = $messageService;
        $this->settingsService = $settingsService;
        $this->fleetMissionService = $fleetMissionService;
        $this->highscoreService = $highscoreService;
    }

    /**
     * Compose the view and pass any required variables.
     *
     * @param View $view
     */
    public function setPlanets(?Collection $planets): void
{
    $this->planets = $planets;
}
public function resources()
{
    return $this->hasMany(Resource::class);
}
public function travelTo(Location $location)
{
    $this->current_location_id = $location->id;
    $this->save();
}

    public function compose(View $view): void
    {
        if (!$this->player->getPlanets()) {
    $this->player->load(auth()->id());
}


        $this->player->setPlanets = collect($loadedPlanets ?? []);
        $current_location = $this->player->getCurrentLocation();
       
        

        // Include body_id, which might have been set in the controller.
        $body_id = $this->request->attributes->get('body_id');

        // Get current locale
        $locale = App::getLocale();

        $highscoreRank = Cache::remember('player-highscore' . $this->player->getId(), now()->addMinutes(5), function () {
            return $this->highscoreService->getHighscorePlayerRank($this->player);
        });

        $view->with([
            'underAttack' => $this->fleetMissionService->currentPlayerUnderAttack(),
            'unreadMessagesCount' => $this->messageService->getUnreadMessagesCount(),
            'resources' => $resources,
            'currentPlayer' => $this->player,
            'currentPlanet' => $this->player->setPlanets->current(),
            'planets' => $this->player->setPlanets,
            'highscoreRank' => $highscoreRank,
            'settings' => $this->settingsService,
            'body_id' => $body_id,
            'locale' => $locale,
        ]);
    }
}
