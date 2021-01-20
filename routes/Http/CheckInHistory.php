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

            Route::get('/users_checkin_report', [CheckinHistoryController::class, 'userCheckinList'])->name('checkin.users.report');

            Route::post('/get_user_checkin', [CheckinHistoryController::class, 'getUserCheckinRecord'])->name('checkin.history.user');

            Route::post('/delete_checkin_user_modal', [CheckinHistoryController::class, 'deleteCheckinUserModal'])->name('checkin.delete.user.modal');

            Route::post('/confirm_delete_checkin_user', [CheckinHistoryController::class, 'deleteConfirmCheckinUser'])->name('checkin.confirm.delete.user');

            Route::post('/edit_checkin_user_modal', [CheckinHistoryController::class, 'editCheckinUserModal'])->name('checkin.edit.user.modal');
            Route::post('/update_checkin_user', [CheckinHistoryController::class, 'updateCheckinUser'])->name('checkin.update.user');
            Route::get('/test', [CheckinHistoryController::class, 'show'])->name('checkin.test');
        });
    }
}
