<?php

namespace Route\Http;

use App\Http\Controllers\AttendanceController;
use \Illuminate\Support\Facades\Route;

class Attendance
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/attendance/mark', [AttendanceController::class, 'index'])->name('attendance.mark');
            Route::get('/attendance/add', [AttendanceController::class, 'markAttendance'])->name('attendance.add');
            Route::post('/attendance/get/location', [AttendanceController::class, 'location'])->name('attendance.get.location');


            Route::get('attendance/list/today', [AttendanceController::class, 'verifyAttendance'])->name('attendance.list.today');
            Route::post('attendance/history/user', [AttendanceController::class, 'getUserAttendanceHistory'])->name('attendance.history.user');

        });
    }
}
