<?php

namespace App\Services;

use App\Models\Card;
use App\Interfaces\Services\ICardService;
use App\Interfaces\Repositories\ICardRepository;

class CardService implements ICardService
{
    /**
     * @var ICardRepository
     */
    private ICardRepository $cardRepository;

    /**
     * @param ICardRepository $cardRepository
     */
    public function __construct(ICardRepository $cardRepository) {
        $this->cardRepository = $cardRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function playCard(Card $card): Card
    {
        return $this->cardRepository->playCard($card);
    }
}
