<?php

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


Route::group(
    [
        'middleware' => ['backend-api'],
        'prefix' => 'headquarters-api',
    ],
    static function (): void {
        $sRouteDir   = base_path() . '/routes/backend/headquarters/';
        $aRouteFiles = glob($sRouteDir . '*.php');
        foreach ($aRouteFiles as $sRouteFile) {
            include $sRouteFile;
        }
        unset($aRouteFiles);
    },
);

Route::group(
    [
        'middleware' => ['merchant-api'],
        'prefix' => 'merchant-api',
    ],
    static function (): void {
        $sRouteDir   = base_path() . '/routes/backend/merchant/';
        $aRouteFiles = glob($sRouteDir . '*.php');
        foreach ($aRouteFiles as $sRouteFile) {
            include $sRouteFile;
        }
        unset($aRouteFiles);
    },
);

Route::group(
    [
        'name' => 'frontend-main',
        'namespace' => 'App\Http\Controllers\FrontendApi\Common',
    ],
    static function (): void {
        $sRouteFile = base_path() . '/routes/frontend/frontend-main-route.php';
        include $sRouteFile;
        unset($sRouteFile);
    },
);
