<?php

namespace Route\Http;

use App\Http\Controllers\ProjectController;
use \Illuminate\Support\Facades\Route;

class HumanResource
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
//            Route::match(['get', 'post'],'projects/list', [ProjectController::class, 'projectList'])->name('project.list');
        });
    }
}
