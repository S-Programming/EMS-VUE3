<?php

namespace Route\Http;

use App\Http\Controllers\TechnologyStackController;
use \Illuminate\Support\Facades\Route;

class TechnologyStack
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/technology/stack/list', [TechnologyStackController::class, 'index'])->name('technology.stack.list');
            Route::post('add/technology/stack/modal', [TechnologyStackController::class, 'technologyStackModal'])->name('technology.stack.add.modal');
            Route::post('confirm/add/technology/stack', [TechnologyStackController::class, 'confirmAddTechnologyStack'])->name('confirm.add.technology.stack');
            Route::post('edit/technology/stack/modal', [TechnologyStackController::class, 'editTechnologyStackModal'])->name('edit.technology.stack.modal');
            Route::post('confirm/edit/technology/stack', [TechnologyStackController::class, 'confirmEditTechnologyStack'])->name('confirm.edit.technology.stack');
            Route::post('delete/technology/stack/modal', [TechnologyStackController::class, 'deleteTechnologyStackModal'])->name('delete.technology.stack.modal');
            Route::post('confirm/delete/technology/stack', [TechnologyStackController::class, 'confirmDeleteTechnologyStack'])->name('confirm.delete.technology.stack');



        });

    }
}
