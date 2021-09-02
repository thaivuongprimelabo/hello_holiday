<?php
use Cms\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'api'], function () {
    Route::match(['get'], '/index', [ApiController::class, 'index'])->name('index');
    Route::match(['get'], '/cities', [ApiController::class, 'getCities'])->name('cities');
    Route::match(['get'], '/districts/{city}', [ApiController::class, 'getDistricts'])->name('districts');
    Route::match(['get'], '/blocks/{district}', [ApiController::class, 'getBlocks'])->name('blocks');
    Route::match(['get'], '/select-products', [ApiController::class, 'selectProducts'])->name('selectProducts');

});
