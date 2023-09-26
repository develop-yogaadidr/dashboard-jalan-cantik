<?php

namespace App\Http\Controllers;

use App\Services\CityService;
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
        $selected_year = $request->selected_year ?? "all";
        $selected_status = $request->selected_status ?? "all";
        $selected_city = $request->selected_city ?? "all";

        $city_service = new CityService;
        $cities = $city_service->getAll();

        $filter_year = $selected_year == "all" ? "" : "&period=" . $selected_year;
        $filter_status = $selected_status == "all" ? "" : "&main_filter[]=status," . $selected_status;
        $filter_city = $selected_city == "all" ? "" : "&main_filter[]=city_id," . $selected_city;

        $url = URL::to('/') . "/dashboard/data/laporan?join=city,user&main_filter[]=type," . $kasus . $filter_status . $filter_city . $filter_year;

        return view('pages.dashboard.daftar-laporan-kasus', [
            "title" => "Daftar Laporan " . $kasus, "active_menu" => "kasus-jalan",  "url" => $url,
            "filter" => [
                "selected_year" => $selected_year,
                "selected_status" => $selected_status,
                "selected_city" => $selected_city,
            ], "cities" => $cities->body->data
        ]);
    }

    // Data Purposes

    public function getDataLaporan(Request $request)
    {
        $service = new ReportService;
        $users = $service->getAll($request->getQueryString());

        return response()->json($users);
    }
}
