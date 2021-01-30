<?php

use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/{category}/images/{imageId}', [UploadController::class, 'loadImage']);
//Route::get('/event-floor-layouts/pdf/{id}', [UploadController::class, 'verifyAttendance']);
Route::delete('/image', [UploadController::class, 'loadImage']);
Route::post('/image/process', [UploadController::class, 'uploadImage']);
