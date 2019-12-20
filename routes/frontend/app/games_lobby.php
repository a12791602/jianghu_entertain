<?php

use App\Http\Controllers\FrontendApi\App\GamesLobbyController;

// 游戏大厅
Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        Route::match(
            ['get', 'options'],
            'rich-list',
            [GamesLobbyController::class, 'richList',],
        )->name('app-api.games-lobby.rich-list');
    },
);
// 游戏大厅
Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'app-api.games-lobby.';
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
            ->name($namePrefix . 'rich-list');
    },
);
