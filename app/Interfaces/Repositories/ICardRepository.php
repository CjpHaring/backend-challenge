<?php

namespace App\Interfaces\Repositories;

use App\Models\Card;
use App\Models\Hand;
use Illuminate\Database\Eloquent\Collection;

interface ICardRepository
{
    /**
     * @return Collection
     */
    public function getCardsForHand(): Collection;

    /**
     * @return ?Card
     */
    public function getNewCard(): ?Card;

    /**
     * @return Card
     */
    public function getLastPlayedCard(): Card;

    /**
     * @param Hand $hand
     * 
     * @return Card
     */
    public function takeCardToHand(Hand $hand): Card;

    /**
     * @param Card $card
     * 
     * @return Card
     */
    public function playCard(Card $card): Card; 

    /**
     * @return void
     */
    public function resetCards(): void;
}
