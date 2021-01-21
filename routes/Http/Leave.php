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

            /*All Route For Leave Type*/
            Route::get('/leave_type_list', [LeaveController::class, 'leaveType'])->name('leave.type.list');
            Route::post('/add_leave_type_modal', [LeaveController::class, 'addLeaveTypeModal'])->name('leave.add.type.modal');
            Route::post('/leave_type_confirm_add', [LeaveController::class, 'leaveTypeConfirmAdd'])->name('leave.type.confirm.add');

            Route::post('/edit_leave_type_modal', [LeaveController::class, 'editLeaveType'])->name('leave.type.edit');
            Route::post('/leave_type_update', [LeaveController::class, 'leaveTypeUpdate'])->name('leave.type.update');

            Route::post('/delete_leave_type_modal', [LeaveController::class, 'leaveTypeDeleteModal'])->name('leave.type.delete.modal');
            Route::post('/leave_type_confirm_delete', [LeaveController::class, 'leaveTypeDeleteConfirm'])->name('leave.type.delete.confirm');

            /*All Route For Leave Status*/
            Route::get('/leave_status_list', [LeaveController::class, 'leaveStatus'])->name('leave.status.list');
            Route::post('/add_leave_status_modal', [LeaveController::class, 'addLeaveStatusModal'])->name('leave.add.status.modal');
            Route::post('/leave_status_confirm_add', [LeaveController::class, 'leaveStatusConfirmAdd'])->name('leave.status.confirm.add');
            Route::post('/edit_leave_status_modal', [LeaveController::class, 'editLeaveStatusModal'])->name('leave.status.edit.modal');
            Route::post('/leave_status_update', [LeaveController::class, 'leaveStatusUpdate'])->name('leave.status.update');
            Route::post('/delete_leave_status_modal', [LeaveController::class, 'leaveStatusDeleteModal'])->name('leave.status.delete.modal');
            Route::post('/leave_status_confirm_delete', [LeaveController::class, 'leaveStatusDeleteConfirm'])->name('leave.status.delete.confirm');

            /*All Route For Approve Leave*/
            Route::get('/approve_leave_list', [LeaveController::class, 'approveLeave'])->name('leave.approve.list');
            Route::post('/approve_leave_modal', [LeaveController::class, 'approveLeaveModal'])->name('leave.approve.leave.modal');
            Route::post('/confirm_approve_leave', [LeaveController::class, 'confirmApproveLeaveModal'])->name('leave.confirm.approve.leave');
        });
    }
}
