<?php

namespace Route\Http;

use App\Http\Controllers\TechnologyStackController;
use \Illuminate\Support\Facades\Route;

class TechnologyStack
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/technology_stack_list', [TechnologyStackController::class, 'index'])->name('technology.stack.list');
            Route::post('add_technology_stack_modal', [TechnologyStackController::class, 'technologyStackModal'])->name('technology.stack.add.modal');
            Route::post('confirm_add_technology_stack', [TechnologyStackController::class, 'confirmAddTechnologyStack'])->name('confirm.add.technology.stack');
            Route::post('edit_technology_stack_modal', [TechnologyStackController::class, 'editTechnologyStackModal'])->name('edit.technology.stack.modal');
            Route::post('confirm_edit_technology_stack', [TechnologyStackController::class, 'confirmEditTechnologyStack'])->name('confirm.edit.technology.stack');
            Route::post('delete_technology_stack_modal', [TechnologyStackController::class, 'deleteTechnologyStackModal'])->name('delete.technology.stack.modal');
            Route::post('confirm_delete_technology_stack', [TechnologyStackController::class, 'confirmDeleteTechnologyStack'])->name('confirm.delete.technology.stack');



        });

    }
}
