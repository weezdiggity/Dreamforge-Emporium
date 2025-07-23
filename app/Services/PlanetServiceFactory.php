<?php

namespace OGame\Services;

use OGame\Models\Planet;

class PlanetServiceFactory
{
    /**
     * Create a PlanetService from a Planet model and PlayerService.
     *
     * @param Planet $planet
     * @param PlayerService $player
     * @return PlanetService
     */
   public function makeFromModel(Planet $planet, PlayerService $player): PlanetService
{
    return new PlanetService(
        app(\OGame\Factories\PlayerServiceFactory::class),
        app(\OGame\Services\SettingsService::class),
        $player,
        $planet,
        $planet->id
    );
}

}