<?php

namespace App\Interfaces\Services;

use App\Models\Hand;
use App\Models\Player;

interface IHandService
{
    /**
     * @param Player $player
     * 
     * @return Hand
     */
    public function getHandOfCards(Player $player): Hand;
}
