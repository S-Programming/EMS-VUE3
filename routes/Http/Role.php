<?php

namespace Route\Http;

use App\Http\Controllers\RoleController;
use \Illuminate\Support\Facades\Route;

class Role
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/role', [RoleController::class, 'index'])->name('role.list');
            Route::post('/add_role_modal', [RoleController::class, 'roleModal'])->name('role.modal');
            Route::post('/confirm_addrole', [RoleController::class, 'confirmAddRole'])->name('role.confirm.addrole');
            Route::post('/delete_role_modal', [RoleController::class, 'roleDeleteModal'])->name('role.delete.modal');
            Route::post('/confirm_delete_role', [RoleController::class, 'confirmDeleteRole'])->name('role.confirm.delete.role');
            Route::post('/edit_role_modal', [RoleController::class, 'roleModal'])->name('role.edit.modal');
            
            
            
        });

    }
}
