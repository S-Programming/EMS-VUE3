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


        Route::group(['middleware' => ['auth:sanctum','isAdmin']], function () {
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

            /*Route::post('/confirm/delete', [UserController::class, 'confirmDeleteUser'])->name('confirm.delete.user');
            Route::post('/confirm/adduser', [UserController::class, 'confirmAddUser'])->name('confirm.adduser');
            Route::get('/self/edit/profile', [UserController::class, 'selfEditProfile'])->name('user.self.edit');
            Route::post('/update/self/profile', [UserController::class, 'selfUpdateProfile'])->name('user.self.update');
            Route::post('/update/self/password', [UserController::class, 'selfUpdatePassword'])->name('update.self.password');*/
            Route::post('/import/users/by/csv', [UserController::class, 'importUsersCsv'])->name('user.import.by.csv');

//            Admin Route Admin Route
            Route::get('specific/user/profile/{user/id}', [UserController::class, 'viewUserProfilePlusInteractions'])->name('user.specific.profile');
            Route::post('add/user/interaction/point/modal', [UserController::class, 'addUserInteractionModal'])->name('user.add.userInteraction.point.modal');
            Route::post('users/confirm/add/discussionPoint', [UserController::class, 'confirmAddUserInteractionModal'])->name('user.confirm.add.discussionPoint');
            Route::post('users/edit/discussionPoint', [UserController::class, 'editUserInteractionModal'])->name('user.edit.discussionPoint');
            Route::post('delete/user/interaction/modal', [UserController::class, 'deleteUserInteraction'])->name('user.delete.user.interaction.modal');
            Route::post('confirm/delete/user/interaction', [UserController::class, 'deleteConfirmUserInteraction'])->name('user.confirm.delete.user_interaction');
            Route::get('discussions', [UserController::class, 'discussionsView'])->name('user.discussions');

//            Project Manager
            Route::get('project/managers/list', [UserController::class, 'projectManagersList'])->name('user.project.managers');
            Route::post('add/project/manager', [UserController::class, 'addProjectManagerModal'])->name('user.add.project.manager');
            Route::post('confirm/add/project/manager', [UserController::class, 'confirmAddProjectManager'])->name('user.confirm.add.project.manager');
            Route::post('edit/project/manager/modal', [UserController::class, 'editProjectManagerModal'])->name('user.edit.project.manager.modal');
            Route::post('confirm/edit/project/manager', [UserController::class, 'confirmEditProjectManager'])->name('user.confirm.edit.project.manager');
            Route::post('delete/project/manager/modal', [UserController::class, 'deleteProjectManagerModal'])->name('user.delete.project.manager.modal');
            Route::post('confirm/delete/project/manager', [UserController::class, 'confirmDeleteProjectManager'])->name('user.confirm.delete.project.manager');


            // Projects
            Route::get('projects/list', [UserController::class, 'projectList'])->name('user.projects.list');
            Route::post('add/project/modal', [UserController::class, 'addProjectModal'])->name('user.add.project.modal');
            Route::post('confirm/add/project', [UserController::class, 'confirmAddProject'])->name('user.confirm.add.project');
            Route::post('edit/project/modal', [UserController::class, 'editProjectModal'])->name('user.edit.project');
            Route::post('confirm/edit/project/modal', [UserController::class, 'confirmEditProjectModal'])->name('user.confirm.edit.project');
            Route::post('delete/project/modal', [UserController::class, 'deleteProjectModal'])->name('user.delete.project');
            Route::post('confirm/delete/project', [UserController::class, 'confirmDeleteProjectModal'])->name('user.confirm.delete.project');


        });

        // only admin can upload csv
    }
}
