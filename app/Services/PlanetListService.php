<?php

namespace OGame\Services;

use Exception;
use OGame\Services\PlanetServiceFactory;
use OGame\Models\Planet as Planet;
use OGame\Models\Enums\PlanetType;
use OGame\Models\Planet\Coordinate;
use OGame\Models\Fleet;
use OGame\Models\Player;
use Illuminate\Database\Eloquent\Collection;
/**
 * Class PlanetList.
 *
 * Wrapper object which can contain one or more Planet objects.
 *
 * @package OGame\Services
 */
class PlanetListService
{
    public function getCurrentPlanetForPlayer(Player $player): ?Planet
    {
        // Get from session, database, or logic
        return session('current_planet') 
            ?? $this->getDefaultPlanet(); // fallback
    }

    public function setCurrentPlanetForPlayer(Player $player, Planet $planet): void
    {
        session(['current_planet' => $planet]);
    }

    protected function getDefaultPlanet(): ?Planet
    {
        return Planet::first(); // Or some logic for default visit
    }

    /**
     * PlanetListService constructor.
     */
 public function __construct(
    Player $player, // Now OGame\Models\Player
    PlayerService $playerService,
    PlanetServiceFactory $planetServiceFactory,
    SettingsService $settingsService
) {
    $this->player = $player;
    $this->playerService = $playerService;
    $this->planetServiceFactory = $planetServiceFactory;
    $this->settingsService = $settingsService;
    $player = $this->playerService->getCurrentPlayer();

    
    $this->model = new Fleet();  
    $this->moons = [];
    $this->loadPlanets();
}

public function loadPlanets(): void
{
    // Example: get all planets player can currently visit
    $planets = $this->getAccessiblePlanetsForPlayer($this->player);



    foreach ($planets as $planetModel) {
        $planetService = $this->planetServiceFactory->makeFromModel($planetModel, $this->player);

        if ($planetService->getPlanetType() === PlanetType::Planet) {
            $this->planets[] = $planetService;
        } elseif ($planetService->getPlanetType() === PlanetType::Moon) {
            $this->moons[] = $planetService;
        }
    }
}
    public function load(int $player_id): void
{
    $this->user = User::findOrFail($player_id);

    $settingsService = new SettingsService();

    $this->planetListService = new PlanetListService(
        $this,
        $this->planetServiceFactory,
        $settingsService
    );

    // Here you fetch the planets once player is loaded
    $this->planets = $this->planetListService->getAccessiblePlanetsForPlayer($this->player);
}
    public function getAccessiblePlanets(): ?Collection
{
    return $this->planetListService->getAccessiblePlanetsForPlayer($this->player);
}

public function getAccessiblePlanetsForPlayer(Player $player): Collection
{
    // This example returns all planets for now.
    // You can add more complex logic like faction membership, discovered planets, quests, etc.

    return Planet::all();
}

    /**
     * Get already loaded planet or moon by ID.
     * Throws an exception if not found.
     *
     * @throws Exception
     */
    public function getById(int $id): PlanetService
    {
        foreach ($this->planets as $planet) {
            if ($planet->getPlanetId() === $id) {
                return $planet;
            }
        }

        foreach ($this->moons as $moon) {
            if ($moon->getPlanetId() === $id) {
                return $moon;
            }
        }

        throw new Exception("Planet or moon with ID {$id} not found.");
    }


    /**
     * Try to find a planet by its coordinates. Returns null if no planet is found.
     */
    public function getPlanetByCoordinates(Coordinate $coordinate): ?PlanetService
{
    foreach ($this->planets as $planet) {
        $planetCoordinates = $planet->getPlanetCoordinates();
        if (
            $planetCoordinates->galaxy === $coordinate->galaxy &&
            $planetCoordinates->system === $coordinate->system &&
            $planetCoordinates->position === $coordinate->position
        ) {
            return $planet;
        }
    }

    return null;
}

    /**
     * Try to find a moon by its coordinates. Returns null if no moon is found.
     */
    public function getMoonByCoordinates(Coordinate $coordinate): PlanetService|null
    {
        foreach ($this->moons as $moon) {
            $moonCoordinates = $moon->getPlanetCoordinates();
            if ($moonCoordinates->galaxy === $coordinate->galaxy && $moonCoordinates->system === $coordinate->system && $moonCoordinates->position === $coordinate->position) {
                return $moon;
            }
        }

        return null;
    }

    /**
     * Checks whether planet with given ID exists and is owned by the current user.
     *
     * @param int $id
     * @return bool
     */
    public function planetExistsAndOwnedByPlayer(int $id): bool
    {
        foreach ($this->planets as $planet) {
            if ($planet->getPlanetId() === $id) {
                return true;
            }
        }

        foreach ($this->moons as $moon) {
            if ($moon->getPlanetId() === $id) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns current planet of player.
     */
  public function current(): PlanetService
{
    $currentPlanetId = $_SESSION['current_planet_id'] ?? null;

    foreach ($this->planets as $planet) {
        if ($planet->getPlanetId() === $currentPlanetId) {
            return $planet;
        }
    }

    foreach ($this->moons as $moon) {
        if ($moon->getPlanetId() === $currentPlanetId) {
            return $moon;
        }
    }

    // No valid current planet set. Return a dummy for now.
    if (empty($this->planets)) {
        return new PlanetService($this->planetServiceFactory, $settingsServiceInstance, $player, $planet, $planet_id);


            
    }

    return $this->first();
}



    /**
     * Players don't start with a planet.
     *
     * @return PlanetService
     */
  public function first(): ?PlanetService
{
    if (empty($this->planets)) {
        return null; // No exception anymore
    }

    return $this->planets[0];
}



    /**
     * Return array of all planet and moon objects, ordered so that each planet is followed by its moon (if it exists).
     *
     * @return array<PlanetService>
     */
    public function all(): array
    {
        $result = [];

        // First add all planets
        foreach ($this->planets as $planet) {
            $result[] = $planet;

            // Check if this planet has a moon
            if ($planet->hasMoon()) {
                $result[] = $planet->moon();
            }
        }

        return $result;
    }

    /**
     * Return array of all planet objects.
     *
     * @return array<PlanetService>
     */
    public function allPlanets(): array
    {
        return $this->planets;
    }

    /**
     * Return array of all moon objects.
     *
     * @return array<PlanetService>
     */
    public function allMoons(): array
    {
        return $this->moons;
    }

    /**
     * Return array of planet ids.
     *
     * @return array<int>
     */
    public function allIds(): array
    {
        $planetIds = [];
        foreach ($this->planets as $planet) {
            $planetIds[] = $planet->getPlanetId();
        }

        foreach ($this->moons as $moon) {
            $planetIds[] = $moon->getPlanetId();
        }

        return $planetIds;
    }

    /**
     * Get amount of planets.
     *
     * @return int
     */
    public function planetCount(): int
    {
        return count($this->planets);
    }

    /**
     * Get amount of planets and moons combined.
     *
     * @return int
     */
    public function allCount(): int
    {
        return count($this->planets) + count($this->moons);
    }
}
