<?php

use App\Http\Controllers\FrontendApi\Common\GamesLobbyController;

// 游戏大厅
Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'app-api.games-lobby.';
        Route::get('rich-list', [GamesLobbyController::class,'richList'])->name($namePrefix . 'rich-list');
        Route::get('game-categories', [GamesLobbyController::class,'category'])->name($namePrefix . 'category');
        Route::get('game-list', [GamesLobbyController::class,'gameList'])->name($namePrefix . 'game-list');
    },
);
