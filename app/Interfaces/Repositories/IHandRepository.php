<?php

namespace App\Interfaces\Repositories;

use App\Models\Hand;
use App\Models\Player;

interface IHandRepository
{
    /**
     * @return Hand
     */
    public function create(Player $player): Hand;

    /**
     * @return void
     */
    public function deleteHands(): void;
}