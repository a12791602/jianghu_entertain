<?php

Route::group(
    ['prefix' => 'games-lobby'],
    static function (): void {
        $namePrefix = 'h5-api.games-lobby.';
        Route::get('rich-list', 'GamesLobbyController@richList')->name($namePrefix . 'rich-list');
        Route::get('game-categories', 'GamesLobbyController@category')->name($namePrefix . 'category');
        Route::get('game-list', 'GamesLobbyController@gameList')->name($namePrefix . 'game-list');
    },
);
