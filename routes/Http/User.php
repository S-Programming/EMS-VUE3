<?php

namespace Route\Http;

use App\Http\Controllers\UserController;
use \Illuminate\Support\Facades\Route;

class User
{
    static function register()
    {

        Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function () {
            Route::get('/user', [UserController::class, 'index'])->name('user.list');
        });
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/add_user_modal', [UserController::class, 'userModal'])->name('user.modal');
            Route::post('/edspecific_user_profileit_user_modal', [UserController::class, 'userModal'])->name('user.edit.modal');
            Route::post('/delete_user_modal', [UserController::class, 'userDeleteModal'])->name('user.delete.modal');

            Route::post('/confirm_delete', [UserController::class, 'confirmDeleteUser'])->name('user.confirm.delete.user');
            Route::post('/confirm_adduser', [UserController::class, 'confirmAddUser'])->name('user.confirm.adduser');

            Route::get('/user_edit_profile', [UserController::class, 'userEditProfile'])->name('user.edit.profile');
            Route::post('/user_update_profile', [UserController::class, 'userUpdateProfile'])->name('user.update.profile');
            Route::post('/user_update_password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');

            Route::post('/user_report_history', [UserController::class, 'userReportHistory'])->name('user.report.history');

            /*Route::post('/confirm_delete', [UserController::class, 'confirmDeleteUser'])->name('confirm.delete.user');
            Route::post('/confirm_adduser', [UserController::class, 'confirmAddUser'])->name('confirm.adduser');
            Route::get('/self_edit_profile', [UserController::class, 'selfEditProfile'])->name('user.self.edit');
            Route::post('/update_self_profile', [UserController::class, 'selfUpdateProfile'])->name('user.self.update');
            Route::post('/update_self_password', [UserController::class, 'selfUpdatePassword'])->name('update.self.password');*/
            Route::post('/import_users_by_csv', [UserController::class, 'importUsersCsv'])->name('user.import.by.csv');

//            Admin Route Admin Route
            Route::get('specific_user_profile/{user_id}', [UserController::class, 'viewUserProfilePlusInteractions'])->name('user.specific.profile');
            Route::post('add_userInteraction_point_modal', [UserController::class, 'addUserInteractionModal'])->name('user.add.userInteraction.point.modal');
            Route::post('users_confirm_add_discussionPoint', [UserController::class, 'confirmAddUserInteractionModal'])->name('user.confirm.add.discussionPoint');
            Route::post('users_edit_discussionPoint', [UserController::class, 'editUserInteractionModal'])->name('user.edit.discussionPoint');
            Route::post('delete_user_interaction_modal', [UserController::class, 'deleteUserInteraction'])->name('user.delete.user.interaction.modal');
            Route::post('confirm_delete_user_interaction', [UserController::class, 'deleteConfirmUserInteraction'])->name('user.confirm.delete.user_interaction');
            Route::get('discussions', [UserController::class, 'discussionsView'])->name('user.discussions');

//            Project Manager
            Route::get('project_managers_list', [UserController::class, 'projectManagersList'])->name('user.project.managers');
            Route::post('add_project_manager', [UserController::class, 'addProjectManagerModal'])->name('user.add.project.manager');
            Route::post('confirm_add_project_manager', [UserController::class, 'confirmAddProjectManager'])->name('user.confirm.add.project.manager');
            Route::post('edit_project_manager_modal', [UserController::class, 'editProjectManagerModal'])->name('user.edit.project.manager.modal');
            Route::post('confirm_edit_project_manager', [UserController::class, 'confirmEditProjectManager'])->name('user.confirm.edit.project.manager');
            Route::post('delete_project_manager_modal', [UserController::class, 'deleteProjectManagerModal'])->name('user.delete.project.manager.modal');
            Route::post('confirm_delete_project_manager', [UserController::class, 'confirmDeleteProjectManager'])->name('user.confirm.delete.project.manager');


            // Projects
            Route::get('projects_list', [UserController::class, 'projectList'])->name('user.projects.list');
            Route::post('add_project_modal', [UserController::class, 'addProjectModal'])->name('user.add.project.modal');
            Route::post('confirm_add_project_modal', [UserController::class, 'confirmAddProjectModal'])->name('user.confirm.add.project');
            Route::post('edit_project_modal', [UserController::class, 'editProjectModal'])->name('user.edit.project');
            Route::post('confirm_edit_project_modal', [UserController::class, 'confirmEditProjectModal'])->name('user.confirm.edit.project');
            Route::post('delete_project_modal', [UserController::class, 'deleteProjectModal'])->name('user.delete.project');
            Route::post('confirm_delete_project', [UserController::class, 'confirmDeleteProjectModal'])->name('user.confirm.delete.project');


        });

        // only admin can upload csv
    }
}
