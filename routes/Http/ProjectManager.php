<?php

namespace Route\Http;

use App\Http\Controllers\ProjectManagerController;
use \Illuminate\Support\Facades\Route;

class ProjectManager
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/assign_project_list', [ProjectManagerController::class, 'index'])->name('assign.project.list');
            Route::post('/add_technology_stack_modal', [ProjectManagerController::class, 'technologyStackModal'])->name('technology.stack.add.modal');
            Route::post('/confirm_add_technology_stack', [ProjectManagerController::class, 'confirmAddTechnologyStack'])->name('confirm.add.technology.stack');
            Route::post('edit_technology_stack_modal', [ProjectManagerController::class, 'editTechnologyStackModal'])->name('edit.technology.stack.modal');
            Route::post('confirm_edit_technology_stack', [ProjectManagerController::class, 'confirmEditTechnologyStack'])->name('confirm.edit.technology.stack');
            Route::post('delete_technology_stack_modal', [ProjectManagerController::class, 'deleteTechnologyStackModal'])->name('delete.technology.stack.modal');
            Route::post('confirm_delete_technology_stack', [ProjectManagerController::class, 'confirmDeleteTechnologyStack'])->name('confirm.delete.technology.stack');
            
            
            
        });

    }
}
