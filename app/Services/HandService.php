<?php

namespace App\Services;

use App\Models\Hand;
use App\Models\Player;
use App\Interfaces\Services\IHandservice;
use App\Interfaces\Repositories\ICardRepository;
use App\Interfaces\Repositories\IHandRepository;

class HandService implements IHandservice
{
    /**
     * @var IHandRepository
     */
    private IHandRepository $handRepository;

    /**
     * @var ICardRepository
     */
    private ICardRepository $cardRepository;

    /**
     * @param ICardRepository $cardRepository
     */
    public function __construct(IHandRepository $handRepository, ICardRepository $cardRepository) {
        $this->handRepository = $handRepository;
        $this->cardRepository = $cardRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function getHandOfCards(Player $player): Hand
    {
        $hand = $this->handRepository->create($player);

        for ($i=0; $i <= 6; $i++) {
            $this->cardRepository->takeCardToHand($hand);
        }

        return $hand->fresh();
    }
}
