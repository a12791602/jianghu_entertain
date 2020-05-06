<?php

use App\Http\Controllers\FrontendApi\Common\GamesLobbyController;

Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'h5-api.games-lobby.';
        Route::get('rich-list', [GamesLobbyController::class, 'richList'])->name($namePrefix . 'rich-list');
        Route::post('game-categories', [GamesLobbyController::class, 'category'])->name($namePrefix . 'category');
        Route::post('game-list', [GamesLobbyController::class, 'gameList'])->name($namePrefix . 'game-list');
        Route::post('slides', [GamesLobbyController::class, 'slides'])->name($namePrefix . 'slides');
        Route::get(
            'in-game/{game_types_id}/{sub_types_id}/{game_series_id}',
            [
             GamesLobbyController::class,
             'inGame',
            ],
        )->name($namePrefix . 'in-game');
        Route::post(
            'in-game-register/{vendor}',
            [
             GamesLobbyController::class,
             'inGameRegister',
            ],
        )->name($namePrefix . 'in-game-register');
        Route::post(
            'in-game-reset-password/{vendor}',
            [
             GamesLobbyController::class,
             'inGameResetPassword',
            ],
        )->name($namePrefix . 'in-game-reset-password');
        Route::post(
            'in-game-balance/{vendor}',
            [
             GamesLobbyController::class,
             'inGameBalance',
            ],
        )->name($namePrefix . 'in-game-balance');
    },
);
