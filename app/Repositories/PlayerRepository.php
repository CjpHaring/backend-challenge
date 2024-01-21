<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Repositories\IPlayerRepository;

class PlayerRepository implements IPlayerRepository
{
    /**
     * {@inheritDoc}
     */
    public function all(): Collection
    {
        return Player::all();
    }
}