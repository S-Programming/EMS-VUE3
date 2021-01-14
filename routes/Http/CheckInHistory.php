<?php

namespace Route\Http;

use App\Http\Controllers\CheckinHistoryController;
use \Illuminate\Support\Facades\Route;

class CheckInHistory
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/checkin_modal', [CheckinHistoryController::class, 'checkinModal'])->name('checkin.modal');
            Route::post('/confirm_checkin', [CheckinHistoryController::class, 'confirmCheckin'])->name('confirm.checkin');
            Route::post('/checkout_modal', [CheckinHistoryController::class, 'checkoutModal'])->name('checkout.modal');
            Route::post('/confirm_checkout', [CheckinHistoryController::class, 'confirmCheckout'])->name('confirm.checkout');
            Route::get('/all_checkin_list', [CheckinHistoryController::class,'allCheckinList'])->name('all.checkin.list');
            Route::post('/get_user_checkin', [CheckinHistoryController::class,'getUserCheckinRecord'])->name('get.user.checkin');
        });
    }
}
