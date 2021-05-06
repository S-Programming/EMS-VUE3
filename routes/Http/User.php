<?php

namespace Route\Http;

use App\Http\Controllers\UserController;
use \Illuminate\Support\Facades\Route;
use App\Http\Traits\AuthUser;

class User
{
    use AuthUser;
    static function register()
    {


        //        Route::group(['middleware' => ['auth:sanctum','isAdmin']], function () {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            //   if($this->getAuthUserId())
            Route::get('/user', [UserController::class, 'index'])->name('user.list');
        });

        //        Route::group(['middleware' => ['auth:sanctum','isSuperAdmin']], function () {
        //            Route::get('/user', [UserController::class, 'index'])->name('user.list');
        //        });
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/add/user/modal', [UserController::class, 'userModal'])->name('user.modal');
            Route::post('/edspecific/user/profileit/user/modal', [UserController::class, 'userModal'])->name('user.edit.modal');
            Route::post('/delete/user/modal', [UserController::class, 'userDeleteModal'])->name('user.delete.modal');

            Route::post('/confirm/delete', [UserController::class, 'confirmDeleteUser'])->name('user.confirm.delete.user');
            Route::post('/confirm/adduser', [UserController::class, 'confirmAddUser'])->name('user.confirm.adduser');

            Route::get('/user/edit/profile', [UserController::class, 'userEditProfile'])->name('user.edit.profile');
            Route::post('/user/update/profile', [UserController::class, 'userUpdateProfile'])->name('user.update.profile');
            Route::post('/user/update/password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');

            Route::post('/user/report/history', [UserController::class, 'userReportHistory'])->name('user.report.history');

            Route::post('/import/users/by/csv', [UserController::class, 'importUsersCsv'])->name('user.import.by.csv');
            Route::post('/check/current/password', [UserController::class, 'checkCurrentPassword'])->name('check.current.password');
            
            Route::get('/user/policy', [UserController::class, 'userPolicy'])->name('user.policy');
            // Route::get('/policy', function () {
            //     return view('pages.policy');
            // });
            //            Admin Route Admin Route
            //            Route::get('specific/user/profile/{user/id}', [UserController::class, 'viewUserProfilePlusInteractions'])->name('user.specific.profile');
            //            Route::post('add/user/interaction/point/modal', [UserController::class, 'addUserInteractionModal'])->name('user.add.userInteraction.point.modal');
            //            Route::post('users/confirm/add/discussionPoint', [UserController::class, 'confirmAddUserInteractionModal'])->name('user.confirm.add.discussionPoint');
            //            Route::post('users/edit/discussionPoint', [UserController::class, 'editUserInteractionModal'])->name('user.edit.discussionPoint');
            //            Route::post('delete/user/interaction/modal', [UserController::class, 'deleteUserInteraction'])->name('user.delete.user.interaction.modal');
            //            Route::post('confirm/delete/user/interaction', [UserController::class, 'deleteConfirmUserInteraction'])->name('user.confirm.delete.user_interaction');
            //            Route::get('discussions', [UserController::class, 'discussionsView'])->name('user.discussions');
        });

        // only admin can upload csv
    }
}
