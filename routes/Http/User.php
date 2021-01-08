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
             Route::post('/confirm_adduser', [UserController::class, 'confirmAdduser'])->name('confirm.adduser');
        });

    }
}
