<?php

use App\Http\Controllers\FrontendApi\Common\GamesLobbyController;

Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'h5-api.games-lobby.';
        Route::get('rich-list', [GamesLobbyController::class,'richList'])->name($namePrefix . 'rich-list');
        Route::get('game-categories', [GamesLobbyController::class,'category'])->name($namePrefix . 'category');
        Route::get('game-list', [GamesLobbyController::class,'gameList'])->name($namePrefix . 'game-list');
    },
);
