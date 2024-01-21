<?php

namespace App\Repositories;

use App\Models\Hand;
use App\Models\Player;
use App\Interfaces\Repositories\IHandRepository;

class HandRepository implements IHandRepository 
{
    /**
     * {@inheritDoc}
     */
    public function create(Player $player): Hand
    {
        return Hand::create(['player_id' => $player->id]);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteHands(): void
    {
        Hand::query()->delete();
    }
}
