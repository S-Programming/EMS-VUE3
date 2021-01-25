<?php

namespace Route\Http;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Test\TestController;
use \Illuminate\Support\Facades\Route;

class Test
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/test_open_modal', [TestController::class, 'testModalOpen'])->name('test.modal.open');
            Route::get('/upload', [TestController::class, 'upload'])->name('test.upload');
        });
    }
}
