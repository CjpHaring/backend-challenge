<?php

use App\Http\Controllers\PlayerController;

Route::get('/all', [PlayerController::class, 'all']);
Route::post('/play-turn', [PlayerController::class, 'playTurn']);
Route::get('/new-hand', [PlayerController::class, 'getNewHand']);