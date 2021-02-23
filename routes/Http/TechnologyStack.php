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
            Route::post('/add_technology_stack_modal', [TechnologyStackController::class, 'technologyStackModal'])->name('technology.stack.add.modal');
            // Route::post('/confirm_addrole', [TechnologyStackController::class, 'confirmAddRole'])->name('role.confirm.addrole');
            // Route::post('/delete_role_modal', [TechnologyStackController::class, 'roleDeleteModal'])->name('role.delete.modal');
            // Route::post('/confirm_delete_role', [TechnologyStackController::class, 'confirmDeleteRole'])->name('role.confirm.delete.role');
            // Route::post('/edit_role_modal', [TechnologyStackController::class, 'roleModal'])->name('role.edit.modal');
            
            
            
        });

    }
}
