<?php
use Illuminate\Support\Facades\Route;

use Cms\Controllers\ApiController;

Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'api'], function () {
    Route::match(['get'], '/index',  [ApiController::class, 'index'])->name('index');
    Route::match(['get'], '/districts/{city}',  [ApiController::class, 'getDistricts'])->name('districts');
    Route::match(['get'], '/blocks/{district}',  [ApiController::class, 'getBlocks'])->name('blocks');
});