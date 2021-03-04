<?php

namespace Route\Http;

//use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AdminController;
use \Illuminate\Support\Facades\Route;

class Admin
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('user/profile/{user_id}', [AdminController::class, 'viewUserProfilePlusInteractions'])->name('admin.user.profile');
            Route::post('add/user/interaction/point/modal', [AdminController::class, 'addUserInteractionModal'])->name('admin.add.userInteraction.point.modal');
            Route::post('users/confirm/add/discussionPoint', [AdminController::class, 'confirmAddUserInteraction'])->name('admin.confirm.add.discussionPoint');
            Route::post('users/edit/discussionPoint', [AdminController::class, 'editUserInteractionModal'])->name('admin.edit.discussionPoint');
            Route::post('delete/user/interaction/modal', [AdminController::class, 'deleteUserInteraction'])->name('admin.delete.user.interaction.modal');
            Route::post('confirm/delete/user/interaction', [AdminController::class, 'deleteConfirmUserInteraction'])->name('admin.confirm.delete.user_interaction');
            Route::get('discussions', [AdminController::class, 'discussionsView'])->name('admin.user.discussions');

        });
    }
}
