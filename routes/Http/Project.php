<?php

namespace Route\Http;

use App\Http\Controllers\ProjectController;
use \Illuminate\Support\Facades\Route;

class Project
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::match(['get', 'post'],'projects/list', [ProjectController::class, 'projectList'])->name('project.list');
            Route::post('add/project/modal', [ProjectController::class, 'addProjectModal'])->name('project.add.project.modal');
            Route::post('confirm/add/project', [ProjectController::class, 'confirmAddProject'])->name('project.confirm.add.project');
            Route::post('edit/project/modal', [ProjectController::class, 'editProjectModal'])->name('project.edit.project');
            Route::post('confirm/edit/project', [ProjectController::class, 'confirmEditProject'])->name('project.confirm.edit');
            Route::post('view/project/modal', [ProjectController::class, 'viewProjectModal'])->name('project.view.project');
            Route::post('delete/project/modal', [ProjectController::class, 'deleteProjectModal'])->name('project.delete.project');
            Route::post('confirm/delete/project', [ProjectController::class, 'confirmDeleteProjectModal'])->name('project.confirm.delete.project');

            Route::post('user/working/projects', [ProjectController::class, 'workingProjectsList'])->name('project.manager.working.projects');
            Route::post('/working/project/Status/modal', [ProjectController::class, 'workingProjectStatusModal'])->name('project.manager.working.project.status.modal');
            Route::post('confirm/working/project/Status', [ProjectController::class, 'confirmWorkingProjectStatus'])->name('project.manager.confirm.working.project.status');
            Route::post('user/completed/projects', [ProjectController::class, 'completedProjectsList'])->name('project.manager.completed.projects');



//            Route::get('/working/project/list', [ProjectController::class, 'workingProjectList'])->name('engagement.manager.working.project.list');

        });
    }
}
