<?php

namespace Route\Http;

use App\Http\Controllers\CheckinHistoryController;
use \Illuminate\Support\Facades\Route;

class CheckInHistory
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/checkin/history/bt/dates', [CheckinHistoryController::class, 'checkinHistoryBtDates'])->name('checkin.history.bt.dates');
            Route::post('/checkin/modal', [CheckinHistoryController::class, 'checkinModal'])->name('checkin.modal');
            Route::post('/confirm/checkin', [CheckinHistoryController::class, 'confirmCheckin'])->name('confirm.checkin');
            // Route::post('/checkout/modal', [CheckinHistoryController::class, 'checkoutModal'])->name('checkout.modal');
            // Route::post('/confirm/checkout', [CheckinHistoryController::class, 'confirmCheckout'])->name('confirm.checkout');
            // Route::post('/report/submit/{force?}', [CheckinHistoryController::class, 'confirmCheckout'])->name('report.submit');
            Route::get('/all/users/checkin/report', [CheckinHistoryController::class, 'allUsersCheckinList'])->name('all.users.checkin.report');
            Route::get('/checkin/report', [CheckinHistoryController::class, 'checkinList'])->name('checkin.report');
            Route::post('/get/user/checkin', [CheckinHistoryController::class, 'getUserCheckinRecord'])->name('checkin.history.user');
            Route::post('/delete/checkin/user/modal', [CheckinHistoryController::class, 'deleteCheckinUserModal'])->name('checkin.delete.user.modal');
            Route::post('/confirm/delete/checkin/user', [CheckinHistoryController::class, 'deleteConfirmCheckinUser'])->name('checkin.confirm.delete.user');
            Route::post('/edit/checkin/user/modal', [CheckinHistoryController::class, 'editCheckinUserModal'])->name('checkin.edit.user.modal');
            Route::post('/update/checkin/user', [CheckinHistoryController::class, 'updateCheckinUser'])->name('checkin.update.user');
            Route::get('/test', [CheckinHistoryController::class, 'show'])->name('checkin.test');
        });
    }
}
