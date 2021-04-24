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
            Route::get('/report', [ReportController::class, 'index'])->name('report.index');
            Route::post('/report/create/modal', [ReportController::class, 'reportCreateModal'])->name('report.create.modal');
            Route::post('/report/create', [ReportController::class, 'reportCreate'])->name('report.create');
            Route::post('/report/edit/modal', [ReportController::class, 'reportEditModal'])->name('report.edit.modal');
            Route::post('/report/edit', [ReportController::class, 'reportEdit'])->name('report.edit');
            Route::post('/report/delete/modal', [ReportController::class, 'reportDeleteModal'])->name('report.delete.modal');
            Route::post('/report/delete', [ReportController::class, 'reportDelete'])->name('report.delete');
            Route::post('/report/submit/{force?}', [ReportController::class, 'reportSubmit'])->name('report.submit');
            //Report today
            Route::post('/report/today/modal', [ReportController::class, 'reportTodayModal'])->name('report.today.modal');
            
        });
    }
}
