<?php

namespace Route\Http;

use App\Http\Controllers\RequestStatusController;
use \Illuminate\Support\Facades\Route;

class RequestStatus
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
			Route::get('/request/status/list', [RequestStatusController::class, 'requestStatus'])->name('request.status.list');
            Route::post('/add/status/modal', [RequestStatusController::class, 'addStatusModal'])->name('request.add.status.modal');
            Route::post('/request/status/confirm/add', [RequestStatusController::class, 'statusConfirmAdd'])->name('request.status.confirm.add');
            Route::post('/edit/status/modal', [RequestStatusController::class, 'editStatusModal'])->name('request.status.edit.modal');
            Route::post('/request/status/update', [RequestStatusController::class, 'statusUpdate'])->name('request.status.update');
            Route::post('/delete/status/modal', [RequestStatusController::class, 'statusDeleteModal'])->name('request.status.delete.modal');
            Route::post('/status/confirm/delete', [RequestStatusController::class, 'statusDeleteConfirm'])->name('request.status.delete.confirm');

		});
	}
}
