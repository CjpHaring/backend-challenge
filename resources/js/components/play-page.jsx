import axios from 'axios';
import ReactDOM from 'react-dom';
import React, { useEffect, useState } from 'react';

export default function PlayPage() {
    const [resetMessage, setResetMessage] = useState(undefined);
    const [winningUser, setWinningUser] = useState(undefined);
    const [playTurns, setPlayTurns] = useState(['Start of game']);

    const getActivePlayers = async () => {
        const response = await axios.get('/api/player/all');

        const playersWithHands = await Promise.all(
            response.data.map(async (player) => {
                const handResponse = await axios.post(`/api/player/new-hand/${player.id}`);
                return handResponse.data;
            })
        );

        return playersWithHands;
    };

    const playGame = async (players) => {
        let gameOver = false;

        for (let i = 0; i < 50; i++) {
            if (gameOver) {
                break;
            };

            await new Promise(resolve => setTimeout(resolve, 1500));

            if (i > 0) {
                setPlayTurns(prevTurns => [
                    ...prevTurns,
                    'Next Round',
                ]);
            }

            for (const player of players) {
                await new Promise(resolve => setTimeout(resolve, 1000));
                const playedPlayer = await playTurn(player);

                if (playedPlayer.hand.cards.length == 0) {
                    setWinningUser(`${playedPlayer.name} has won!`);
                    gameOver = true;
                    resetGame();
        
                    break;
                }
            }
        }
    };

    const resetGame = () => {
        axios.post('/api/player/reset-game').then(response => setResetMessage('The game has been reset, refresh to start over.'));
    }

    const playTurn = async (player) => {
        let playedCard, grabbedCard, playedPlayer;
        
        await axios.post(`/api/player/play-turn/${player.id}`).then(response => {
            playedPlayer = response.data.player;
            playedCard = response.data.playedCard;
            grabbedCard = response.data.grabbedCard;
        })

        const action = playedCard ? 'played' : 'grabbed';
        const card = playedCard || grabbedCard;

        setPlayTurns(prevTurns => [
            ...prevTurns,
            `${playedPlayer.name} ${action} the card ${card?.number} ${card?.type} and has ${playedPlayer.hand.cards.length} cards left`,
        ]);

        return playedPlayer;
    }

    useEffect(() => {
        const fetchData = async () => {
            const playersWithHands = await getActivePlayers();
            await playGame(playersWithHands);
        };

        fetchData();
    }, []);

    return (
        <div>
            <h1>Mau mau!</h1>
            <div>
                {playTurns.map(turn => 
                    <span>{turn}<br/></span>
                )}
            </div>
            <div>{winningUser ?? ''}</div>
            <div>{resetMessage ?? ''}</div>
        </div>
    );
}

if (document.getElementById('play-page')) {
    ReactDOM.render(<PlayPage />, document.getElementById('play-page'));
}
