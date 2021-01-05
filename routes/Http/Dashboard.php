<?php

namespace Route\Http;

use App\Http\Controllers\DashboardController;
use \Illuminate\Support\Facades\Route;

class Dashboard
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
    }
}
