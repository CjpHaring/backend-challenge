<?php

namespace App\Repositories;

use App\Models\Card;
use App\Models\Hand;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Repositories\ICardRepository;

class CardRepository implements ICardRepository
{
    /**
     * {@inheritDoc}
     */
    public function getCardsForHand(): Collection
    {
        return Card::whereNull('hand_id')->inRandomOrder()->take(7)->get();
    }

    /**     
     * {@inheritDoc}
     */
    public function getNewCard(): ?Card
    {
        return Card::where('hand_id', null)->where('played', false)->inRandomOrder()->first();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastPlayedCard(): Card
    {
        $lastPlayedCard = Card::where('hand_id', null)->where('played', true)->latest('updated_at')->first();

        if (!$lastPlayedCard) { 
            $lastPlayedCard = $this->getNewCard();
            $lastPlayedCard->update(['played' => true]);
        }

        return $lastPlayedCard->fresh();
    }

    /**
     * {@inheritDoc}
     */
    public function takeCardToHand(Hand $hand): Card
    {
        $card = $this->getNewCard();

        if (!$card) {
            $lastPlayedCardId = $this->getLastPlayedCard()->id;
            Card::whereNotIn('id', [$lastPlayedCardId])->update(['played' => false]);
        }

        $card = $this->getNewCard();
        $card->update(['hand_id' => $hand->id]);

        return $card->fresh();
    }

    /**
     * {@inheritDoc}
     */
    public function playCard(Card $card): Card
    {
        $card->update(['played' => true, 'hand_id' => null]);

        return $card->fresh();
    }

    /**
     * {@inheritDoc}
     */
    public function resetCards(): void
    {
        Card::all()->each(function (Card $card) {
            $card->update(['played' => false, 'hand_id' => null]);
        });
    }
}
