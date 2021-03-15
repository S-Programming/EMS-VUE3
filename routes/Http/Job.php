<?php

namespace Route\Http;

use App\Http\Controllers\JobController;
use \Illuminate\Support\Facades\Route;

class Job
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/jobs', [JobController::class, 'jobList'])->name('job.list');
            Route::post('/add/job/modal', [JobController::class, 'addJobModal'])->name('job.add.modal');
        });
    }
}
