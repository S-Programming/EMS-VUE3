<?php

namespace Route\Http;

use App\Http\Controllers\ProjectManagerController;
use \Illuminate\Support\Facades\Route;

class ProjectManager
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::match(['get', 'post'],'/projects', [ProjectManagerController::class, 'assignProjectList'])->name('project.manager.assigned.projects');
            Route::post('/developers/request/modal', [ProjectManagerController::class, 'developersRequestModal'])->name('project.manager.developers.request.modal');
            Route::post('/confirm/developers/request', [ProjectManagerController::class, 'confirmDevelopersRequest'])->name('project.manager.confirm.developers.request');



//            Route::post('/add/technology/stack/modal', [ProjectManagerController::class, 'technologyStackModal'])->name('technology.stack.add.modal');
//            Route::post('/confirm/add/technology/stack', [ProjectManagerController::class, 'confirmAddTechnologyStack'])->name('confirm.add.technology.stack');
//            Route::post('edit/technology/stack/modal', [ProjectManagerController::class, 'editTechnologyStackModal'])->name('edit.technology.stack.modal');
//            Route::post('confirm/edit/technology/stack', [ProjectManagerController::class, 'confirmEditTechnologyStack'])->name('confirm.edit.technology.stack');
//            Route::post('delete/technology/stack/modal', [ProjectManagerController::class, 'deleteTechnologyStackModal'])->name('delete.technology.stack.modal');
//            Route::post('confirm/delete/technology/stack', [ProjectManagerController::class, 'confirmDeleteTechnologyStack'])->name('confirm.delete.technology.stack');



        });

    }
}
