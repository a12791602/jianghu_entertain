<?php

use App\Http\Controllers\FrontendApi\H5\GamesLobbyController;

// 游戏大厅
Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'h5-api.games-lobby.';
        Route::match(
            ['get', 'options'],
            'rich-list',
            [GamesLobbyController::class, 'richList'],
        )
        ->name($namePrefix . 'rich-list');
        Route::match(
            ['get', 'options'],
            'game-categories',
            [GamesLobbyController::class, 'category'],
        )
        ->name($namePrefix . 'category');
        Route::match(
            ['get', 'options'],
            'game-list',
            [GamesLobbyController::class, 'gameList'],
        )
        ->name($namePrefix . 'game-list');
    },
);
