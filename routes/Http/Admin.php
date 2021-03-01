<?php

namespace Route\Http;

//use App\Http\Controllers\AttendanceController;
use \Illuminate\Support\Facades\Route;

class Admin
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
//            Route::get('/attendance_mark', [AttendanceController::class, 'index'])->name('attendance.mark');


        });
    }
}
