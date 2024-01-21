<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Interfaces\Services\IHandService;
use App\Interfaces\Services\IPlayerService;
use Illuminate\Database\Eloquent\Collection;

class PlayerController extends Controller 
{
    /**
     * @var IPlayerService
     */
    private IPlayerService $playerService;

    /**
     * @var IHandService
     */
    private IHandService $handservice;

    /**
     * @param IPlayerService $playerService
     * @param IHandService $handservice
     */
    public function __construct(IPlayerService $playerService, IHandService $handservice)
    {
        $this->playerService = $playerService;
        $this->handservice = $handservice;
    }

    /**
     * @return Collection<int, Player>
     */
    public function all(): Collection
    {
        return $this->playerService->all();
    }

    /**
     * @param Player $player
     * 
     * @return array
     */
    public function playTurn(Player $player): array
    {
        return $this->playerService->playTurn($player);
    }

    /**
     * @param Player $player
     * 
     * @return Player
     */
    public function getNewHand(Player $player): Player
    {
        $this->handservice->getHandOfCards($player);

        return $player->fresh();
    }

    /**
     * @return void
     */
    public function resetGame(): void
    {
        $this->playerService->resetGame();
    }
}
