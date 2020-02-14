<?php

use App\Http\Controllers\BackendApi\Merchant\System\ConfigController;

Route::post('config/edit', [ConfigController::class, 'edit'])->name('merchant-api.config.edit');
