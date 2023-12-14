<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RoadController;
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
Route::get('/laporan-masuk/{id}', [PublicController::class, 'detailLaporanMasuk']);
Route::get('/laporan-diterima-ai', [PublicController::class, 'laporanDiterimaAi']);
Route::get('/laporan-diterima-ai/Provinsi', [PublicController::class, 'laporanDiterimaAiProvinsi']);
Route::get('/laporan-diterima-ai/KabupatenKota', [PublicController::class, 'laporanDiterimaAiByKota'])->name("laporan-diterima-ai-kabupaten-kota");
Route::get('/laporan-diterima-ai/Desa', [PublicController::class, 'laporanDiterimaAiByKota'])->name("laporan-diterima-ai-desa");;
Route::get('/laporan-ditolak-ai', [PublicController::class, 'laporanDitolakAi']);
Route::get('/download', [PublicController::class, 'download']);
Route::get('/kontak', [PublicController::class, 'kontak']);
Route::get('/privacy-policy', [PublicController::class, 'privacyPolicy']);

if (env("APP_ENV", "production") == "local") {
    Route::get('login', [AuthController::class, 'loginDevelopment'])->name("login");
} else {
    Route::get('login', [AuthController::class, 'login'])->name("login");
}

Route::post('login', [AuthController::class, 'loginProcess']);
if (env("APP_ENV", "production") == "local") {
    Route::post('login-development', [AuthController::class, 'loginDevelopmentProcess']);
}

Route::prefix("data")->group(function () {
    Route::get('/laporan', [PublicController::class, 'getDataLaporan']);
    Route::get('/laporan-kinerja/{status_jalan}', [PublicController::class, 'getDataKinerja']);
});

Route::prefix("dashboard")->middleware([EnsureSessionIsValid::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logoutProcess']);

    Route::prefix("laporan")->group(function () {
        Route::get('/', [LaporanController::class, 'daftarLaporanByStatus']);
        Route::get('/status-jalan', [LaporanController::class, 'statusJalan']);
        Route::get('/kasus-jalan', [LaporanController::class, 'kasusJalan']);
        Route::get('/{id}', [LaporanController::class, 'detailLaporan']);
        Route::get('/{id}/{status}', [LaporanController::class, 'prosesLaporan']);
        Route::post('/{id}/{status}/create', [LaporanController::class, 'createProsesLaporan']);
    });

    Route::prefix("profile")->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/update', [ProfileController::class, 'updateProfile']);
    });

    Route::get('/kelola-ai', [ConfigController::class, 'kelolaAi']);
    Route::post('/update-ai', [ConfigController::class, 'updateAi']);

    Route::prefix("kelola-peta")->group(function () {
        Route::get('/', [RoadController::class, 'index']);
        Route::post('/update', [RoadController::class, 'update']);
        Route::get('/{id}', [RoadController::class, 'detail']);
    });

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
        Route::get('/roads', [RoadController::class, 'getDataRoads']);
    });
});
