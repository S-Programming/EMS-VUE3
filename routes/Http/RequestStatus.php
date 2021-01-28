<?php

namespace Route\Http;

use App\Http\Controllers\RequestStatusController;
use \Illuminate\Support\Facades\Route;

class RequestStatus
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
			Route::get('/request_status_list', [RequestStatusController::class, 'requestStatus'])->name('request.status.list');
            Route::post('/add_status_modal', [RequestStatusController::class, 'addStatusModal'])->name('request.add.status.modal');
            Route::post('/request_status_confirm_add', [RequestStatusController::class, 'statusConfirmAdd'])->name('request.status.confirm.add');
            Route::post('/edit_status_modal', [RequestStatusController::class, 'editStatusModal'])->name('request.status.edit.modal');
            Route::post('/request_status_update', [RequestStatusController::class, 'statusUpdate'])->name('request.status.update');
            Route::post('/delete_status_modal', [RequestStatusController::class, 'statusDeleteModal'])->name('request.status.delete.modal');
            Route::post('/status_confirm_delete', [RequestStatusController::class, 'statusDeleteConfirm'])->name('request.status.delete.confirm');

		});
	}
}