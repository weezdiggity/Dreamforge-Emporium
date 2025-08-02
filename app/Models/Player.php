<?php

namespace OGame\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $table = 'players'; // make sure this matches your DB table

    protected $fillable = [
        'user_id', 'username', 'race', 'alliance', // etc.
    ];

    // Example relationship to planets
    public function planets(): HasMany
    {
        return $this->hasMany(Planet::class);
    }
}
