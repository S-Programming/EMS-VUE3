<?php

namespace Route\Http;

use App\Http\Controllers\ReportController;
use \Illuminate\Support\Facades\Route;
use App\Http\Traits\AuthUser;

class Report
{
    use AuthUser;
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            //my route
            // Route::post('/checkin/history/bt/dates', [CheckinHistoryController::class, 'checkinHistoryBtDates'])->name('checkin.history.bt.dates');

            // Route::post('/checkin/modal', [CheckinHistoryController::class, 'checkinModal'])->name('checkin.modal');
            // Route::post('/confirm/checkin', [CheckinHistoryController::class, 'confirmCheckin'])->name('confirm.checkin');
            // Route::post('/checkout/modal', [CheckinHistoryController::class, 'checkoutModal'])->name('checkout.modal');
            // Route::post('/confirm/checkout', [CheckinHistoryController::class, 'confirmCheckout'])->name('confirm.checkout');
            // Route::post('/report/submit/{force?}', [CheckinHistoryController::class, 'confirmCheckout'])->name('report.submit');

            // Route::get('/all/users/checkin/report', [CheckinHistoryController::class, 'allUsersCheckinList'])->name('all.users.checkin.report');
            // Route::get('/checkin/report', [CheckinHistoryController::class, 'checkinList'])->name('checkin.report');

            // Route::post('/get/user/checkin', [CheckinHistoryController::class, 'getUserCheckinRecord'])->name('checkin.history.user');

            // Route::post('/delete/checkin/user/modal', [CheckinHistoryController::class, 'deleteCheckinUserModal'])->name('checkin.delete.user.modal');

            // Route::post('/confirm/delete/checkin/user', [CheckinHistoryController::class, 'deleteConfirmCheckinUser'])->name('checkin.confirm.delete.user');

            // Route::post('/edit/checkin/user/modal', [CheckinHistoryController::class, 'editCheckinUserModal'])->name('checkin.edit.user.modal');

            // Route::post('/update/checkin/user', [CheckinHistoryController::class, 'updateCheckinUser'])->name('checkin.update.user');
            // Route::get('/test', [CheckinHistoryController::class, 'show'])->name('checkin.test');

            // Today Report Routes
            Route::get('/report', [ReportController::class, 'index'])->name('report.index');
            Route::post('/report/create/modal', [ReportController::class, 'reportCreateModal'])->name('report.create.modal');
            Route::post('/report/create', [ReportController::class, 'reportCreate'])->name('report.create');
            Route::post('/report/edit/modal', [ReportController::class, 'reportEditModal'])->name('report.edit.modal');
            Route::post('/report/edit', [ReportController::class, 'reportEdit'])->name('report.edit');
            Route::post('/report/delete/modal', [ReportController::class, 'reportDeleteModal'])->name('report.delete.modal');
            Route::post('/report/delete', [ReportController::class, 'reportDelete'])->name('report.delete');
        });
    }
}
