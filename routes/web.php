<?php

use App\Http\Controllers\CicoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Route\Http\Admin;
use Route\Http\Dashboard;
use Route\Http\Feedback;
use Route\Http\Project;
use Route\Http\SuperAdmin;
use Route\Http\User;
use Route\Http\Role;
use Route\Http\CheckInHistory;
use Route\Http\Expense;
use Route\Http\Holiday;
use Route\Http\Leave;
use Route\Http\Attendance;
use Route\Http\Pdf;
use Route\Http\ProjectManager;
use Route\Http\EngagementManager;
use Route\Http\HumanResource;
use Route\Http\RequestStatus;
use Route\Http\Test;
use Route\Http\UserQuries;
use Route\Http\TechnologyStack;
use Route\Http\Job;
use Route\Http\Report;

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
Project::register();
Report::register();
Test::register();
//Feedback::register();
UserQuries::register();
TechnologyStack::register();
ProjectManager::register();
EngagementManager::register();
Admin::register();
SuperAdmin::register();
Job::register();
HumanResource::register();
