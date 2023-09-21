<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

Route::prefix("dashboard")->middleware([EnsureSessionIsValid::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logoutProcess']);
    Route::get('/laporan/status-jalan', [DashboardController::class, 'statusJalan']);
    Route::get('/laporan/kasus-jalan', [DashboardController::class, 'kasusJalan']);
    Route::get('/kelola-ai', [ConfigController::class, 'kelolaAi']);
    Route::get('/kelola-peta', [DashboardController::class, 'kelolaPeta']);
    Route::post('/update-ai', [ConfigController::class, 'updateAi']);
    Route::get('/daftar-user', [UserController::class, 'index']);
    Route::get('/daftar-user/admin', [UserController::class, 'getUserAdmin']);
    Route::get('/daftar-user/pelapor', [UserController::class, 'getUserPelapor']);
    Route::get('/detail-user/{id}', [UserController::class, 'getUserById']);

    Route::get('/data/user', [UserController::class, 'getUserData']);
    Route::get('/data/user/admin', [UserController::class, 'getUserDataAdmin']);
    Route::get('/data/user/pelapor', [UserController::class, 'getUserDataPelapor']);
});
