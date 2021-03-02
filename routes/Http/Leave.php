<?php

namespace Route\Http;

use App\Http\Controllers\LeaveController;
use \Illuminate\Support\Facades\Route;

class Leave
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/leave', [LeaveController::class, 'index'])->name('leave.list');
            Route::post('/request/leave/modal', [LeaveController::class, 'requestLeaveModal'])->name('leave.request.modal');
            Route::post('/confirm/request/leave', [LeaveController::class, 'confirmRequestLeave'])->name('leave.confirm.request');
            // Route::post('/deleterole/modal', [RoleController::class, 'roleDeleteModal'])->name('role.delete.modal');
            // Route::post('/confirm/delete/role', [RoleController::class, 'confirmDeleteRole'])->name('role.confirm.delete.role');
            // Route::post('/editrole/modal', [RoleController::class, 'roleModal'])->name('role.edit.modal');

            /*All Route For Leave Type*/
            Route::get('/leave/type/list', [LeaveController::class, 'leaveType'])->name('leave.type.list');
            Route::post('/add/leave/type/modal', [LeaveController::class, 'addLeaveTypeModal'])->name('leave.add.type.modal');
            Route::post('/leave/type/confirm/add', [LeaveController::class, 'leaveTypeConfirmAdd'])->name('leave.type.confirm.add');

            Route::post('/edit/leave/type/modal', [LeaveController::class, 'editLeaveType'])->name('leave.type.edit');
            Route::post('/leave/type/update', [LeaveController::class, 'leaveTypeUpdate'])->name('leave.type.update');

            Route::post('/delete/leave/type/modal', [LeaveController::class, 'leaveTypeDeleteModal'])->name('leave.type.delete.modal');
            Route::post('/leave/type/confirm/delete', [LeaveController::class, 'leaveTypeDeleteConfirm'])->name('leave.type.delete.confirm');


            /*All Route For Approve Leave*/
            Route::get('/approve/leave/list', [LeaveController::class, 'approveLeave'])->name('approve.leave.list');

            Route::post('/approve/leave/modal', [LeaveController::class, 'approveLeaveModal'])->name('leave.approve.leave.modal');
            Route::post('/confirm/approve/leave', [LeaveController::class, 'confirmApproveLeaveModal'])->name('leave.confirm.approve.leave');
        });
    }
}
