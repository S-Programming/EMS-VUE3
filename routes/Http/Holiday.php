<?php

namespace Route\Http;

use App\Http\Controllers\HolidayController;
use \Illuminate\Support\Facades\Route;

class Holiday
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/holiday', [HolidayController::class, 'index'])->name('holiday.list');
            Route::post('/add/holiday/modal', [HolidayController::class, 'holidayModal'])->name('holiday.add.modal');

            Route::post('/confirm/add/holiday', [HolidayController::class, 'confirmAddHoliday'])->name('holiday.confirm.add');

            Route::post('/edit/holiday/modal', [HolidayController::class, 'holidayEditModal'])->name('holiday.edit.modal');
            Route::post('/update/holiday/modal', [HolidayController::class, 'holidayUpdate'])->name('holiday.update');

            Route::post('/delete/holiday/modal', [HolidayController::class, 'holidayDeleteModal'])->name('holiday.delete.modal');

            Route::post('/confirm/delete/holiday', [HolidayController::class, 'confirmDeleteHoliday'])->name('holiday.confirm.delete');

        });
    }
}
