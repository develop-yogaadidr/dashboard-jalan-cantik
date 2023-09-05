<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $service = new ReportService;
        $statusLaporan = $service->getCounterStatusLaporan();
        $statusJalan = $service->getCounterStatusJalan();

        return view('pages.dashboard.index', ["title" => "Laporan Dalam Angka", "active_menu" => "dashboard", "data" => ["status_laporan" => $statusLaporan, "status_jalan" => $statusJalan]]);
    }

    // laporan masuk
    public function statusJalan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getCounterStatusJalan();

        return view('pages.dashboard.laporan-status', ["title" => "Laporan Masuk Berdasarkan Status Jalan",  "active_menu" => "status-jalan", "data" => $response]);
    }

    public function kasusJalan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getCounterKasusJalan();

        return view('pages.dashboard.laporan-kasus', ["title" => "Laporan Masuk Berdasarkan Kasus Jalan", "active_menu" => "kasus-jalan", "data" => $response]);
    }

    public function kelolaAi(Request $request)
    {
        return view('pages.dashboard.under-construction', ["title" => "Kelola AI", "active_menu" => "kelola-ai"]);
    }

    public function KelolaUser(Request $request)
    {
        return view('pages.dashboard.under-construction', ["title" => "Kelola User", "active_menu" => "kelola-user"]);
    }

    public function kelolaPeta(Request $request)
    {
        return view('pages.dashboard.under-construction', ["title" => "Kelola Peta", "active_menu" => "kelola-peta"]);
    }
}
