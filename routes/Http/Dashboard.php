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
            Route::get('/dashboard1', function(){
            	dd(2);
            })->name('dashboard1');
            Route::post('/checkin_modal', [DashboardController::class, 'checkinModal'])->name('checkin.modal');
            Route::post('/confirm_checkin', [DashboardController::class, 'confirmCheckin'])->name('confirm.checkin');
        });
    }
}
