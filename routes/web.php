<?php

use App\Http\Controllers\CicoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Route\Http\Dashboard;
use Route\Http\User;
use Route\Http\Role;
use Route\Http\CheckInHistory;
use Route\Http\Expense;
use Route\Http\Holiday;
use Route\Http\Leave;
use Route\Http\Attendance;
use Route\Http\Pdf;
use Route\Http\RequestStatus;
use Route\Http\Test;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

// Example Routes
Route::get('/', function () {
    $view = (Auth::check()) ? 'dashboard' : 'login';
    return redirect()->route($view);
});
Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');




Dashboard::register();
User::register();
Role::register();
CheckInHistory::register();
Leave::register();
Attendance::register();
RequestStatus::register();
Expense::register();
Holiday::register();
Pdf::register();
Test::register();
