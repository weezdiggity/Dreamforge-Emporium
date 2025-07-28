<?php

namespace OGame\Services;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OGame\GameObjects\Models\Calculations\CalculationType;
use OGame\Models\FleetMission;
use OGame\Models\Planet;
use OGame\Models\Resources;
use OGame\Models\User;
use OGame\Models\Player;
use OGame\Services\PlayerService;
use OGame\Models\UserTech;
use OGame\Services\PlanetListService;
use RuntimeException;
use Throwable;




namespace OGame\Services;

use OGame\Models\User;
use OGame\Models\Player;
use OGame\Services\PlanetListService;
use OGame\Services\PlanetServiceFactory;

class PlayerService
{
    public ?User $user = null;
    public ?PlanetListService $planets = null;
    private ?UserTech $userTech = null;

    public function __construct()
    {
        // Empty constructor so Laravel can auto-resolve it
    }

    public function load(int $player_id): void
    {
        $this->user = User::findOrFail($player_id);

        $this->planets = new PlanetListService(
            $this,
            app(PlanetServiceFactory::class)
        );
    }

    // ... rest of your PlayerService methods


    public function getPlayer(int $player_id): ?User
{
    return User::find($player_id);
}

   

    public function getId(): int
    {
        return $this->user?->id ?? 0;
    }

    public function equals(?PlayerService $other): bool
    {
        return $other && $this->user->id === $other->user->id;
    }

    public function isPasswordValid(string $password): bool
    {
        return password_verify($password, $this->user->password);
    }

    public function setUserTech(UserTech $userTech): void
    {
        $this->userTech = $userTech;
    }

    public function getUserTech(): ?UserTech
    {
        return $this->userTech;
    }
  



    /**
     * Saves current player object to DB.
     */
    public function save(): void
    {
        $this->user->save();
    }

    /**
     * Checks if the player is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->user->hasRole('admin');
    }

    /**
     * Set username property.
     *
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->user->username = $username;
        $this->user->username_updated_at = now();
    }

    /**
     * Validates a username.
     *
     * @param string $username
     * @return false|int
     */
    public function validateUsername(string $username): false|int
    {
        if (strlen($username) < 3) {
            return false;
        }

        return preg_match('/^[A-Za-z][A-Za-z0-9\s]*(?:_[A-Za-z0-9\s]+)*$/', $username);
    }

    /**
     * Validates if a username is already taken.
     *
     * @param string $username
     * @return bool
     */
    public function isUsernameAlreadyTaken(string $username): bool
    {
        return User::where('username', $username)->exists();
    }

    /**
     * Validates a username.
     *
     * @param string $username
     * @return array<string, mixed>
     */
    public function isUsernameValid(string $username): array
    {
        if (!$this->validateUsername($username)) {
            return [
                'valid' => false,
                'error' => __('Nickname :username contains invalid characters or your nickname has an invalid length!', ['username' => $username])
            ];
        }

        if ($this->isUsernameAlreadyTaken($username)) {
            return [
                'valid' => false,
                'error' => __('Player name already in use or invalid.')
            ];
        }

        return [
            'valid' => true,
            'error' => null
        ];
    }

    /**
     * Get the user's username.
     *
     * @param bool $formatted
     * @return string
     */
    public function getUsername(bool $formatted = true): string
    {
        if ($formatted && $this->isAdmin()) {
            return '<span class="status_abbr_admin">' . $this->user->username . '</span>';
        }
        return $this->user->username;
    }

    /**
     * Get the timestamp of the latest username change.
     *
     * @return Carbon|null
     */
    public function getLastUsernameChange(): Carbon|null
    {
        return $this->user->username_updated_at ? Carbon::parse($this->user->username_updated_at) : null;
    }

    /**
     * Set email address.
     *
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->user->email = $email;
    }

    /**
     * Validates whether input matches current users password.
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        if (Auth::Attempt((['email' => $this->getEmail(), 'password' => $password]))) {
            return true;
        }

        return false;
    }

    /**
     * Get email address.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->user->email;
    }

    /**
     * Gets the level of a research technology for this player.
     *
     * @param string $machine_name
     * @return int
     */
    public function getResearchLevel(string $machine_name): int
    {
        $research = ObjectService::getResearchObjectByMachineName($machine_name);

        $research_level = $this->user_tech->{$research->machine_name} ?? 0;
        if ($research_level) {
            return $research_level;
        } else {
            return 0;
        }
    }

    /**
     * Set the level of a research technology for this player.
     *
     * @param string $machine_name
     * @param int $level
     * @param bool $save_to_db
     * @return void
     */
    public function setResearchLevel(string $machine_name, int $level, bool $save_to_db = true): void
    {
        $research = ObjectService::getResearchObjectByMachineName($machine_name);
        $this->user_tech->{$research->machine_name} = $level;

        if ($save_to_db) {
            $this->user_tech->save();
        }
    }

    /**
     * Get planet ID that player has currently selected / is looking at.
     *
     * @return int
     */
    public function getCurrentPlanetId(): int
{
    //TODO TEMPORARY: Skip planet logic entirely
    return 0; // Or -1 if 0 is used elsewhere
}

    /**
     * Set current planet ID (update).
     *
     * @param int $planet_id
     */
    public function setCurrentPlanetId(int $planet_id): void
    {
        // Check if user owns this planet ID.
        // Planet ID 0 is always valid as that will be updated to the first planet of the player.
        if ($planet_id == 0) {
            $this->user->planet_current = null;
            $this->user->save();
            return;
        } elseif ($this->planets->planetExistsAndOwnedByPlayer($planet_id)) {
            $this->user->planet_current = $planet_id;
            $this->user->save();
        }
    }

    /**
     * Get the amount of fleet slots that the player is currently using.
     *
     * This corresponds to the amount of fleet missions that are currently active for this player.
     *
     * @return int
     */
    public function getFleetSlotsInUse(): int
    {
        $fleetMissionService = resolve(FleetMissionService::class);
        $activeMissions = $fleetMissionService->getActiveFleetMissionsSentByCurrentPlayer();

        return $activeMissions->count();
    }

    /**
     * Get the (maximum) amount of fleet slots that the player has available.
     *
     * This is calculated based on the player's research level and optional bonuses that may apply.
     *
     * @return int
     */
    public function getFleetSlotsMax(): int
    {
        // Calculate max fleet slots based on the user's computer research level.
        // Starts with 1, and every level of computer research adds 1 more slot.
        $starting_fleet_slots = 1;
        $fleet_slots_from_research = $this->getResearchLevel('computer_technology');

        return $starting_fleet_slots + $fleet_slots_from_research;
    }

    /**
     * Update the player entity.
     *
     * This method is called every time the player logs in.
     * It updates the player's last IP and time properties.
     * It also updates the research queue.
     *
     * @return void
     * @throws Throwable
     */
    public function update(): void
{
    $player = User::find($this->getId());

    if (!$player) {
        throw new \Exception('User not found.');
    }

    // Update research queue
    $this->updateResearchQueue(false);

    // Update time and IP
    $player->time = (string) \Illuminate\Support\Carbon::now()->timestamp;
    $player->last_ip = request()->ip();

    $player->save();

    // Sync user reference
    $this->user = $player;
}

    /**
     * Update the research queue for this player.
     *
     * @param bool $save_user
     *   Optional flag whether to save the user in this method. This defaults to TRUE
     *   but can be set to FALSE when update happens in bulk and the caller method calls
     *   the save user itself to prevent on unnecessary multiple updates.
     *
     * @return void
     * @throws Exception
     */
    public function updateResearchQueue(bool $save_user = true): void
    {
        $queue = resolve(ResearchQueueService::class);
        $research_queue = $queue->retrieveFinishedForUser($this);

        // @TODO: add DB transaction wrapper
        foreach ($research_queue as $item) {
            // Get object information of research object.
            $object = ObjectService::getResearchObjectById($item->object_id);

            // Update planet and update level of the building that has been processed.
            $this->setResearchLevel($object->machine_name, $item->object_level_target);

            // Update build queue record
            $item->processed = 1;
            $item->save();

            // Build the next item in queue (if there is any)
            $queue->start($this, $item->time_end);
        }

        if ($save_user) {
            $this->user->save();
        }
    }

    /**
     * @throws Throwable
     */
    public function updateFleetMissions(): void
    {
       \Illuminate\Support\Facades\DB::transaction(function () {
            // Attempt to acquire a lock on the row for this planet. This is to prevent
            // race conditions when multiple requests are updating the fleet missions for the
            // same planet and potentially doing double insertions or overwriting each other's changes.
            $planetIds = $this->planets->allIds();
            $planetMissionUpdateLock = \OGame\Models\Planet::whereIn('id', $planetIds)

                ->lockForUpdate()
                ->get();

            if ($planetMissionUpdateLock->count() === count($planetIds)) {
                try {
                    $fleetMissionService = resolve(FleetMissionService::class);
                    $missions = $fleetMissionService->getArrivedMissionsByPlanetIds($planetIds);

                    foreach ($missions as $mission) {
                        // Attempt to acquire a lock on the row for this fleet mission. This is to prevent
                        // race conditions when multiple requests are updating the same fleet mission and
                        // potentially doing double insertions or overwriting each other's changes.
                        $fleetMissionLock = FleetMission::where('id', $mission->id)
                            ->lockForUpdate()
                            ->first();

                        if ($fleetMissionLock) {
                            $fleetMissionService->updateMission($mission);
                        } else {
                            throw new \Exception('Could not acquire update fleet mission update lock.');
                        }
                    }

                    if ($missions->count() > 0) {
                        // Update the current player object and all child planets to make sure any changes
                        // to the fleet missions are reflected in the player/planet objects.
                        $this->load($this->getId());
                    }
                } catch (Exception $e) {
                    throw new RuntimeException('Fleet mission service process error: ' . $e->getMessage());
                }
            } else {
                throw new \Exception('Could not acquire update fleet mission planet lock.');
            }
        });
    }

    /**
     * Calculate and return planet score based on levels of buildings and amount of units.
     *
     * @return int
     */
    public function getResearchScore(): int
    {
        // For every research in the game, calculate the score based on how much resources it costs to build it.
        // For research it is the sum of resources needed for all levels up to the current level.
        // The score is the sum of all these values.
        $resources_spent = new Resources(0, 0, 0, 0);

        // Create object array
        $research_objects = ObjectService::getResearchObjects();
        foreach ($research_objects as $object) {
            for ($i = 1; $i <= $this->getResearchLevel($object->machine_name); $i++) {
                // Concatenate price which is array of metal, crystal and deuterium.
                $raw_price = ObjectService::getObjectRawPrice($object->machine_name, $i);
                $resources_spent->add($raw_price);
            }
        }

        // Divide the score by 1000 to get the amount of points. Floor the result.
        $resources_sum = $resources_spent->metal->get() + $resources_spent->crystal->get() + $resources_spent->deuterium->get();
        return (int)floor($resources_sum / 1000);
    }

    /**
     * Get array with all research objects that this player has.
     *
     * @return array<string, int>
     */
    public function getResearchArray(): array
    {
        $array = [];
        $objects = ObjectService::getResearchObjects();
        foreach ($objects as $object) {
            if ($this->user_tech->{$object->machine_name} > 0) {
                $array[$object->machine_name] = $this->user_tech->{$object->machine_name};
            }
        }

        return $array;
    }

    /**
     * Get is the player researching any tech or not
     *
     * @return bool
     */
    public function isResearching(): bool
    {
        $research_queue = resolve(ResearchQueueService::class);
        return (bool) $research_queue->activeResearchQueueItemCount($this);
    }

    public function isBuildingShipsOrDefense(): bool
    {
        $unit_queue = resolve(UnitQueueService::class);

        return $unit_queue->isBuildingShipsOrDefense($this->getCurrentPlanetId());
    }

    /**
     * Get is the player researching the tech or not
     *
     * @param string $machine_name
     * @param int $level
     * @return bool
     */
    public function isResearchingTech(string $machine_name, int $level): bool
    {
        $research_queue = resolve(ResearchQueueService::class);
        return $research_queue->objectInResearchQueue($this, $machine_name, $level);
    }

    /**
     * Get the maximum amount of planets that this player can have based on research levels.
     *
     * @return int
     */
    public function getMaxPlanetAmount(): int
{
    $userTech = $this->getUserTech();

    if (!$userTech) {
        // Handle fallback value or throw a helpful exception
        return 1; // Default max planets if no user tech is set
        // OR
        // throw new \RuntimeException("UserTech is not set on PlayerService.");
    }

    $astrophysicsObject = $userTech->getAstrophysicsObject();
    $astrophysicsLevel = $userTech->getAstrophysicsLevel();

    return 1 + $astrophysicsObject->performCalculation(
        \OGame\GameObjects\Models\Calculations\CalculationType::MAX_COLONIES,
        $astrophysicsLevel
    );
}

    /**
     * Delete the player and all associated records from the database.
     *
     * @return void
     */
    public function delete(): void
    {
        // Loop through all planets and delete all records associated with them.
        foreach ($this->planets->all() as $planet) {
            // Delete all queue items.
            \OGame\Models\ResearchQueue::where('planet_id', $planet->getPlanetId())->delete();
            \OGame\Models\BuildingQueue::where('planet_id', $planet->getPlanetId())->delete();
            \OGame\Models\UnitQueue::where('planet_id', $planet->getPlanetId())->delete();
            // Delete all fleet missions.
            // Get all fleet missions for this planet then loop through them and delete them.
            // TODO: this might be a performance bottleneck if there are many missions. Consider using a bulk delete compatible
            // with the foreign key constraints instead.
            $missions = FleetMission::where('planet_id_from', $planet->getPlanetId())->orWhere('planet_id_to', $planet->getPlanetId())->get();
            foreach ($missions as $mission) {
                // Delete any that have this mission as their parent.
                \OGame\Models\FleetMission::where('parent_id', $mission->id)->delete();
                // Delete mission itself.
                $mission->delete();
            }
        }

        // Delete all messages.
        \OGame\Models\Message::where('user_id', $this->getId())->delete();

        // Delete tech record.
        $this->user_tech->delete();

        // Delete all planets.
        \OGame\Models\Planet::where('user_id', $this->getId())->delete();

        // Delete the actual user.
        $this->user->delete();
    }

    /**
     * Get is the player building the object or not
     *
     * @return bool
     */
    public function isBuildingObject(string $machine_name): bool
{
    if ($this->planets === null) {
        // Optionally, throw a meaningful exception or silently return false
        // throw new \RuntimeException('PlayerService::planets is not initialized.');
        return false;
    }

    foreach ($this->planets->all() as $planet) {
        $object_level = $planet->getObjectLevel($machine_name);
        if ($planet->isBuildingObject($machine_name, $object_level + 1)) {
            return true;
        }
    }

    return false;
}
}