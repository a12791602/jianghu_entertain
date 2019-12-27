<?php

// 游戏大厅
Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'app-api.games-lobby.';
        Route::get('rich-list', 'GamesLobbyController@richList')->name($namePrefix . 'rich-list');
        Route::get('game-categories', 'GamesLobbyController@category')->name($namePrefix . 'category');
        Route::get('game-list', 'GamesLobbyController@gameList')->name($namePrefix . 'game-list');
    },
);
