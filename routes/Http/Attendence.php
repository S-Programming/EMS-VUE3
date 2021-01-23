<?php

namespace Route\Http;

use App\Http\Controllers\AttendenceController;
use \Illuminate\Support\Facades\Route;

class Attendence
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/attendence_mark', [AttendenceController::class, 'index'])->name('attendence.mark');
            Route::get('/attendence_add', [AttendenceController::class, 'markAttendence'])->name('attendence.add');
            Route::post('/attendance_get_location', [AttendenceController::class, 'location'])->name('attendence.get.location');
          
        });
    }
}
