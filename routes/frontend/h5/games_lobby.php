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
        Route::post('in-game', [GamesLobbyController::class, 'inGame'])->name($namePrefix . 'in-game');
    },
);
