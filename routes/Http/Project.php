<?php

namespace Route\Http;

use App\Http\Controllers\ProjectController;
use \Illuminate\Support\Facades\Route;

class Project
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('projects/list', [ProjectController::class, 'projectList'])->name('project.list');
            Route::post('add/project/modal', [ProjectController::class, 'addProjectModal'])->name('project.add.project.modal');
            Route::post('confirm/add/project', [ProjectController::class, 'confirmAddProject'])->name('project.confirm.add.project');
            Route::post('edit/project/modal', [ProjectController::class, 'editProjectModal'])->name('project.edit.project');
            Route::post('confirm/edit/project/modal', [ProjectController::class, 'confirmEditProjectModal'])->name('project.confirm.edit');
            Route::post('view/project/modal', [ProjectController::class, 'viewProjectModal'])->name('project.view.project');
            Route::post('delete/project/modal', [ProjectController::class, 'deleteProjectModal'])->name('project.delete.project');
            Route::post('confirm/delete/project', [ProjectController::class, 'confirmDeleteProjectModal'])->name('project.confirm.delete.project');

            Route::get('/working/project/list', [ProjectController::class, 'workingProjectList'])->name('engagement.manager.working.project.list');

        });
    }
}
