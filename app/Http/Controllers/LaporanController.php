<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LaporanController extends Controller
{
    public function detailLaporan(Request $request, $id)
    {
        $service = new ReportService;
        $queryString = "?join=user,city,progress";
        $response = $service->getById($id, $queryString);

        return view('pages.dashboard.laporan-detail', ["title" => "Laporan Detail", "active_menu" => "laporan-masuk", "data" => $response]);
    }

    public function statusJalan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getCounterStatusJalan();

        return view('pages.dashboard.laporan-status', ["title" => "Laporan Masuk Berdasarkan Status Jalan", "active_menu" => "status-jalan", "data" => $response]);
    }

    public function kasusJalan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getCounterKasusJalan();

        return view('pages.dashboard.laporan-kasus', ["title" => "Laporan Masuk Berdasarkan Kasus Jalan", "active_menu" => "kasus-jalan", "data" => $response]);
    }

    public function daftarLaporanByStatusJalan(Request $request, $status)
    {
        $url = URL::to('/') . "/dashboard/data/laporan?join=city,user&main_filter[]=status_jalan," . $status;

        return view('pages.dashboard.daftar-laporan', ["title" => "Daftar Laporan " . $status, "active_menu" => "status-jalan",  "url" => $url]);
    }

    public function daftarLaporanByKasusJalan(Request $request, $kasus)
    {
        $url = URL::to('/') . "/dashboard/data/laporan?join=city,user&main_filter[]=type," . $kasus;

        return view('pages.dashboard.daftar-laporan', ["title" => "Daftar Laporan " . $kasus, "active_menu" => "kasus-jalan",  "url" => $url]);
    }

    // Data Purposes

    public function getDataLaporan(Request $request)
    {
        $service = new ReportService;
        $users = $service->getAll($request->getQueryString());

        return response()->json($users);
    }
}
