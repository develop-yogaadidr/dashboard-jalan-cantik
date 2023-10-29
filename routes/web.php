<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PublicController;
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

Route::get('/', [PublicController::class, 'index']);
Route::get('/tentang', [PublicController::class, 'tentang']);
Route::get('/laporan-masuk', [PublicController::class, 'laporanMasuk']);
Route::get('/laporan-diterima-ai', [PublicController::class, 'laporanDiterimaAi']);
Route::get('/laporan-ditolak-ai', [PublicController::class, 'laporanDitolakAi']);
Route::get('/download', [PublicController::class, 'download']);
Route::get('/kontak', [PublicController::class, 'kontak']);
Route::get('/privacy-policy', [PublicController::class, 'privacyPolicy']);

Route::get('login', [AuthController::class, 'login'])->name("login");
Route::post('login', [AuthController::class, 'loginProcess']);

Route::prefix("dashboard")->middleware([EnsureSessionIsValid::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logoutProcess']);

    Route::prefix("laporan")->group(function () {
        Route::get('/status-jalan', [LaporanController::class, 'statusJalan']);
        Route::get('/kasus-jalan', [LaporanController::class, 'kasusJalan']);
        Route::get('/status-jalan/{status}', [LaporanController::class, 'daftarLaporanByStatusJalan']);
        Route::get('/kasus-jalan/{kasus}', [LaporanController::class, 'daftarLaporanByKasusJalan']);
        Route::get('/status', [LaporanController::class, 'daftarLaporanByStatus']);
        Route::get('/{id}', [LaporanController::class, 'detailLaporan']);
        Route::get('/{id}/{status}', [LaporanController::class, 'prosesLaporan']);
        Route::post('/{id}/{status}/create', [LaporanController::class, 'createProsesLaporan']);
    });

    Route::get('/kelola-ai', [ConfigController::class, 'kelolaAi']);
    Route::get('/kelola-peta', [DashboardController::class, 'kelolaPeta']);
    Route::post('/update-ai', [ConfigController::class, 'updateAi']);

    Route::get('/daftar-user', [UserController::class, 'index']);
    Route::get('/daftar-user/admin', [UserController::class, 'getUserAdmin']);
    Route::get('/daftar-user/pelapor', [UserController::class, 'getUserPelapor']);
    Route::get('/daftar-level-admin', [UserController::class, 'getLevelAdmins']);
    Route::post('/detail-user/simpan', [UserController::class, 'updateUserAdmin']);
    Route::get('/detail-user/{id}', [UserController::class, 'getUserById']);
    Route::post('/detail-level-admin/simpan', [UserController::class, 'updateLevelAdmin']);
    Route::get('/detail-level-admin/{id}', [UserController::class, 'getLevelAdminById']);

    // Only data purposes

    Route::prefix("data")->group(function () {
        Route::get('/laporan', [LaporanController::class, 'getDataLaporan']);
        Route::get('/user', [UserController::class, 'getUserData']);
        Route::get('/user/admin', [UserController::class, 'getUserDataAdmin']);
        Route::get('/user/pelapor', [UserController::class, 'getUserDataPelapor']);
        Route::get('/level-admin', [UserController::class, 'getLevelAdminsData']);
    });
});
