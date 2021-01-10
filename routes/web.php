<?php

use App\Http\Controllers\CicoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Route\Http\Dashboard;
use Route\Http\User;
use Route\Http\Role;
use Route\Http\CheckInHistory;
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

/*
Route::post('ajax/checkintime','CicoController@checkin')->name('cico.checkintime');
Route::post('ajax/checkouttime','CicoController@checkout')->name('cico.checkouttime');*/
/*Route::post('/checkin', [CheckinHistoryController::class, 'checkin'])->middleware('auth')->name('checkin');
Route::post('/checkout', [CheckinHistoryController::class, 'checkout'])->middleware('auth')->name('checkout');
*/
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


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
Test::register();
