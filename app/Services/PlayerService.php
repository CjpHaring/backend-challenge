<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Hand;
use App\Models\Player;
use App\Interfaces\Services\IPlayerService;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\Repositories\IHandRepository;
use App\Interfaces\Repositories\ICardRepository;
use App\Interfaces\Repositories\IPlayerRepository;

class PlayerService implements IPlayerService 
{
    /**
     * @var IPlayerRepository
     */
    private IPlayerRepository $playerRepository;

    /**
     * @var ICardRepository
     */
    private ICardRepository $cardRepository;

    /**
     * @var IHandRepository
     */
    private IHandRepository $handRepository;

    /**
     * @param IPlayerRepository $playerRepository
     * @param ICardRepository $cardRepository
     * @param IHandRepository $handRepository
     */
    public function __construct(IPlayerRepository $playerRepository, ICardRepository $cardRepository, IHandRepository $handRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->cardRepository = $cardRepository;
        $this->handRepository = $handRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function all(): Collection
    {
        return $this->playerRepository->all();
    }

    /**
     * {@inheritDoc}
     */
    public function playTurn(Player $player): array
    {
        $hand = $player->hand;
        $cards = $hand->cards;
        $playedCard = null;
        $grabbedCard = null;

        if ($card = $this->getPlayingCard($cards)) {
            $playedCard = $this->cardRepository->playCard($card);
        } else {
            $grabbedCard = $this->addCardToHand($hand);
        }

        return [
            'player' => $player->fresh(),
            'playedCard' => $playedCard,
            'grabbedCard' => $grabbedCard,
        ];
    }

    /**
     * @param Collection $cards
     * 
     * @return Card|null
     */
    private function getPlayingCard(Collection $cards): ?Card
    {
        $lastPlayedCard = $this->cardRepository->getLastPlayedCard();

        foreach ($cards as $card) {
            $canPlay = $card->type === $lastPlayedCard->type || $card->number === $lastPlayedCard->number;

            if ($canPlay) {
                return $card;
            }
        }

        return null;
    }

    /**
     * @param Hand $hand
     * 
     * @return Card
     */
    public function addCardToHand(Hand $hand): Card
    {
        return $this->cardRepository->takeCardToHand($hand);
    }

    /**
     * {@inheritDoc}
     */
    public function resetGame(): void
    {
        $this->cardRepository->resetCards();
        $this->handRepository->deleteHands();
    }
}
