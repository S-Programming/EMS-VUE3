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
            Route::post('/add_leave_modal', [LeaveController::class, 'addLeaveModal'])->name('leave.add.modal');
            Route::post('/confirm_add_leave', [LeaveController::class, 'confirmAddLeave'])->name('leave.confirm.add');
            // Route::post('/deleterole_modal', [RoleController::class, 'roleDeleteModal'])->name('role.delete.modal');
            // Route::post('/confirm_delete_role', [RoleController::class, 'confirmDeleteRole'])->name('role.confirm.delete.role');
            // Route::post('/editrole_modal', [RoleController::class, 'roleModal'])->name('role.edit.modal');
            
            Route::get('/leave_type_list', [LeaveController::class, 'leaveType'])->name('leave.type.list');
            Route::post('/add_leave_type_modal', [LeaveController::class, 'addLeaveTypeModal'])->name('leave.add.type.modal');
            Route::post('/leave_type_confirm_add', [LeaveController::class, 'leaveTypeConfirmAdd'])->name('leave.type.confirm.add');

            Route::post('/edit_leave_type_modal', [LeaveController::class, 'editLeaveType'])->name('leave.type.edit');
            Route::post('/leave_type_update', [LeaveController::class, 'leaveTypeUpdate'])->name('leave.type.update');

            Route::post('/delete_leave_type_modal', [LeaveController::class, 'leaveTypeDeleteModal'])->name('leave.type.delete.modal');
            Route::post('/leave_type_confirm_delete', [LeaveController::class, 'leaveTypeDeleteConfirm'])->name('leave.type.delete.confirm');
            
        });

    }
    
}
