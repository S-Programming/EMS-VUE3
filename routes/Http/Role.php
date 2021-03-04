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
            Route::post('/add/role/modal', [RoleController::class, 'addRoleModal'])->name('role.modal');
            Route::post('/confirm/addrole', [RoleController::class, 'confirmAddRole'])->name('role.confirm.addrole');
            Route::post('/delete/role/modal', [RoleController::class, 'roleDeleteModal'])->name('role.delete.modal');
            Route::post('/confirm/delete/role', [RoleController::class, 'confirmDeleteRole'])->name('role.confirm.delete.role');
            Route::post('/edit/role/modal', [RoleController::class, 'roleModal'])->name('role.edit.modal');



        });

    }
}
