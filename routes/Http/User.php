<?php

namespace Route\Http;

use App\Http\Controllers\UserController;
use \Illuminate\Support\Facades\Route;

class User
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/user', [UserController::class, 'index'])->name('user.list');
            Route::post('/adduser_modal', [UserController::class, 'userModal'])->name('user.modal');
            Route::post('/edituser_modal', [UserController::class, 'userModal'])->name('user.modal');
            Route::post('/deleteuser_modal', [UserController::class, 'userDeleteModal'])->name('delete.user.modal');
             Route::post('/confirm_delete', [UserController::class, 'confirmDeleteUser'])->name('confirm.delete.user');
             Route::post('/confirm_adduser', [UserController::class, 'confirmAddUser'])->name('confirm.adduser');
        });

    }
}
