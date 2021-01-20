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
            Route::post('/add_leave_modal', [LeaveController::class, 'addLeaveModal'])->name('add.leave.modal');
            Route::post('/confirm_add_leave', [LeaveController::class, 'confirmAddLeave'])->name('confirm.add.leave');
            // Route::post('/deleterole_modal', [RoleController::class, 'roleDeleteModal'])->name('role.delete.modal');
            // Route::post('/confirm_delete_role', [RoleController::class, 'confirmDeleteRole'])->name('role.confirm.delete.role');
            // Route::post('/editrole_modal', [RoleController::class, 'roleModal'])->name('role.edit.modal');
            
            /*All Route For Leave Type*/
            Route::get('/leave_type_list', [LeaveController::class, 'leaveType'])->name('leave.type.list');
            Route::post('/add_leave_type_modal', [LeaveController::class, 'addLeaveTypeModal'])->name('add.leave.type.modal');
            Route::post('/leave_type_confirm_add', [LeaveController::class, 'leaveTypeConfirmAdd'])->name('leave.type.confirm.add');
            
            /*All Route For Approve Leave*/
            Route::get('/approve_leave_list', [LeaveController::class, 'approveLeave'])->name('leave.approve.list');
        });

    }
}
