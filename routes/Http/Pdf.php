<?php

namespace Route\Http;

use App\Http\Controllers\PdfController;
use \Illuminate\Support\Facades\Route;

class Pdf
{
    static function register()
    {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('pdf/attendeanc/history', [PdfController::class, 'attendanceHistory'])->name('pdf.attendance.history');
        });
    }
}
