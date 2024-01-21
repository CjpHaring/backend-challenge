<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('player')->group(function () {
    Route::get('/all', [PlayerController::class, 'all']);
    Route::post('/play-turn/{player}', [PlayerController::class, 'playTurn']);
    Route::post('/new-hand/{player}', [PlayerController::class, 'getNewHand']);
    Route::post('/reset-game', [PlayerController::class, 'resetGame']);
});