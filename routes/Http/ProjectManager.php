<?php

namespace Route\Http;

use App\Http\Controllers\ProjectManagerController;
use \Illuminate\Support\Facades\Route;

class ProjectManager
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::match(['get', 'post'],'/assign/project/list', [ProjectManagerController::class, 'index'])->name('assign.project.list');
            Route::post('/developers/request/modal', [ProjectManagerController::class, 'developersRequestModal'])->name('assign.developers.request.modal');
            Route::post('/confirm/developers/request', [ProjectManagerController::class, 'confirmDevelopersRequest'])->name('assign.confirm.developers.request');


            Route::post('user/working/projects', [ProjectManagerController::class, 'workingProjectsList'])->name('project.manager.working.projects');
            Route::post('/working/project/Status/modal', [ProjectManagerController::class, 'workingProjectStatusModal'])->name('project.manager.working.project.status.modal');
            Route::post('confirm/working/project/Status', [ProjectManagerController::class, 'confirmWorkingProjectStatus'])->name('project.manager.confirm.working.project.status');
            Route::post('user/completed/projects', [ProjectManagerController::class, 'completedProjectsList'])->name('project.manager.completed.projects');
//            Route::post('/add/technology/stack/modal', [ProjectManagerController::class, 'technologyStackModal'])->name('technology.stack.add.modal');
//            Route::post('/confirm/add/technology/stack', [ProjectManagerController::class, 'confirmAddTechnologyStack'])->name('confirm.add.technology.stack');
//            Route::post('edit/technology/stack/modal', [ProjectManagerController::class, 'editTechnologyStackModal'])->name('edit.technology.stack.modal');
//            Route::post('confirm/edit/technology/stack', [ProjectManagerController::class, 'confirmEditTechnologyStack'])->name('confirm.edit.technology.stack');
//            Route::post('delete/technology/stack/modal', [ProjectManagerController::class, 'deleteTechnologyStackModal'])->name('delete.technology.stack.modal');
//            Route::post('confirm/delete/technology/stack', [ProjectManagerController::class, 'confirmDeleteTechnologyStack'])->name('confirm.delete.technology.stack');



        });

    }
}
