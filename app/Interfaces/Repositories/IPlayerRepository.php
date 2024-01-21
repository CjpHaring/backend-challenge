<?php

namespace App\Interfaces\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

interface IPlayerRepository
{
    /**
     * @return Collection<int, Player>
     */
    public function all(): Collection;
}