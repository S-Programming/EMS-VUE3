<?php

namespace Route\Http;

use App\Http\Controllers\EngagementManagerController;
use \Illuminate\Support\Facades\Route;

class EngagementManager
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/assign/developers/modal', [EngagementManagerController::class, 'assignProjectDevelopersModal'])->name('assign.project.developers.modal');
            Route::post('/confirm/assign/developers', [EngagementManagerController::class, 'confirmAssignProjectDevelopers'])->name('assign.confirm.project.developers');

            Route::post('progress/comment/modal', [EngagementManagerController::class, 'commentOnProgressModal'])->name('engagement.manager.comment.progress.mpdal');
            Route::post('confirm/progress/comment', [EngagementManagerController::class, 'confirmCommentOnProgress'])->name('engagement.manager.confirm.comment.progress');
        });

    }
}
