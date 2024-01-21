<?php

namespace App\Interfaces\Services;

use App\Models\Player;
use Illuminate\Database\Eloquent\Collection;

interface IPlayerService
{
    /**
     * @return Collection<int, Collection>
     */
    public function all(): Collection;

    /**
     * @param Player $player
     * 
     * @return array
     */
    public function playTurn(Player $player): array;

    /**
     * @return void
     */
    public function resetGame(): void;
}
