<?php

Route::match(['post', 'options'], 'login', 'FrontendAuthController@login')->name('h5-api.login');

//管理总代用户与玩家
Route::group(
    ['prefix' => 'user'],
    static function (): void {
        $namePrefix = 'h5-api.user.';
        Route::get('logout', 'FrontendAuthController@logout')->name($namePrefix . 'logout');
        Route::put('refresh-token', 'FrontendAuthController@refreshToken')->name($namePrefix . 'refresh-token');
        Route::get('information', 'FrontendUserController@information')->name($namePrefix . 'information');
    },
);
