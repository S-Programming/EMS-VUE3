<?php

namespace Route\Http;

use App\Http\Controllers\AttendanceController;
use \Illuminate\Support\Facades\Route;

class Attendance
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/attendance_mark', [AttendanceController::class, 'index'])->name('attendance.mark');
            Route::get('/attendance_add', [AttendanceController::class, 'markAttendance'])->name('attendance.add');
            Route::post('/attendance_get_location', [AttendanceController::class, 'location'])->name('attendance.get.location');


            Route::get('attendance_list_today', [AttendanceController::class, 'verifyAttendance'])->name('attendance.list.today');
            Route::post('attendance_history_user', [AttendanceController::class, 'getUserAttendanceHistory'])->name('attendance.history.user');
          
        });
    }
}
