<?php

namespace Route\Http;

use App\Http\Controllers\EngagementManagerController;
use \Illuminate\Support\Facades\Route;

class EngagementManager
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/assign_developers_modal', [EngagementManagerController::class, 'assignProjectDevelopersModal'])->name('assign.project.developers.modal');
            Route::post('/confirm_assign_developers', [EngagementManagerController::class, 'confirmAssignProjectDevelopers'])->name('assign.confirm.project.developers');
            Route::get('/working_project_list', [EngagementManagerController::class, 'workingProjectList'])->name('engagement.manager.working.project.list');
        });

    }
}
