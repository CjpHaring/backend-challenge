<?php

namespace App\Interfaces\Services;

use App\Models\Card;

interface ICardService
{
    /**
     * @param Card $card
     * 
     * @return Card
     */
    public function playCard(Card $card): Card;
}