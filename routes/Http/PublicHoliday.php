<?php

namespace Route\Http;

use App\Http\Controllers\PublicHolidayController;
use \Illuminate\Support\Facades\Route;

class PublicHoliday
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/public_holiday', [PublicHolidayController::class, 'index'])->name('public.holiday.list');
            Route::post('/add_public_holiday_modal', [PublicHolidayController::class, 'publicHolidayModal'])->name('public.holiday.add.modal');

            Route::post('/confirm_add_public_holiday', [PublicHolidayController::class, 'confirmAddPublicHoliday'])->name('public.holiday.confirm.add');

            Route::post('/edit_public_holiday_modal', [PublicHolidayController::class, 'publicHolidayEditModal'])->name('public.holiday.edit.modal');
            Route::post('/update_public_holiday_modal', [PublicHolidayController::class, 'publicHolidayUpdate'])->name('public.holiday.update');

            Route::post('/delete_public_holiday_modal', [PublicHolidayController::class, 'publicHolidayDeleteModal'])->name('public.holiday.delete.modal');

            Route::post('/confirm_delete_public_holiday', [PublicHolidayController::class, 'confirmDeletePublicHoliday'])->name('public.holiday.confirm.delete');
          
           
        });
    }
}
