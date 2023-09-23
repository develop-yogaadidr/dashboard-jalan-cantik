<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $service = new ReportService;
        $statusLaporan = $service->getCounterStatusLaporan();
        $statusJalan = $service->getCounterStatusJalan();

        return view('pages.dashboard.index', ["title" => "Laporan Dalam Angka", "active_menu" => "dashboard", "data" => ["status_laporan" => $statusLaporan, "status_jalan" => $statusJalan]]);
    }

    public function kelolaPeta(Request $request)
    {
        return view('pages.dashboard.under-construction', ["title" => "Kelola Peta", "active_menu" => "kelola-peta"]);
    }
}
