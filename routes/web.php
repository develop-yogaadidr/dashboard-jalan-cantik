<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\EnsureSessionIsValid;
use Illuminate\Support\Facades\Route;

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
    return view('pages.welcome');
});

Route::view('login', 'pages.login', ["title" => "Login"])->name("login");

Route::post('login', [AuthController::class, 'loginProcess']);
Route::post('logout', [AuthController::class, 'logoutProcess']);

Route::prefix("dashboard")->middleware([EnsureSessionIsValid::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/laporan/status-jalan', [DashboardController::class, 'statusJalan']);
    Route::get('/laporan/kasus-jalan', [DashboardController::class, 'kasusJalan']);
    Route::get('/kelola-ai', [DashboardController::class, 'kelolaAi']);
    Route::get('/kelola-user', [DashboardController::class, 'kelolaUser']);
    Route::get('/kelola-peta', [DashboardController::class, 'kelolaPeta']);
});