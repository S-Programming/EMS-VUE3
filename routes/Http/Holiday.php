<?php

namespace Route\Http;

use App\Http\Controllers\PublicHolidayController;
use \Illuminate\Support\Facades\Route;

class Holiday
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/holiday', [PublicHolidayController::class, 'index'])->name('holiday.list');
            Route::post('/add_holiday_modal', [PublicHolidayController::class, 'holidayModal'])->name('holiday.add.modal');

            Route::post('/confirm_add_holiday', [PublicHolidayController::class, 'confirmAddHoliday'])->name('holiday.confirm.add');

            Route::post('/edit_holiday_modal', [PublicHolidayController::class, 'holidayEditModal'])->name('holiday.edit.modal');
            Route::post('/update_holiday_modal', [PublicHolidayController::class, 'holidayUpdate'])->name('holiday.update');

            Route::post('/delete_holiday_modal', [PublicHolidayController::class, 'holidayDeleteModal'])->name('holiday.delete.modal');

            Route::post('/confirm_delete_holiday', [PublicHolidayController::class, 'confirmDeleteHoliday'])->name('holiday.confirm.delete');
          
           
        });
    }
}
