<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\Services\ReportService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $service = new ReportService;
        $statusLaporan = $service->getCounterStatusLaporan();
        $statusJalan = $service->getCounterStatusJalan();
        $city_service = new CityService;
        $cities = $city_service->getAll();

        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.index', ["title" => "Laporan Dalam Angka", "active_menu" => "dashboard", "breadcrumbs" => $breadcrumbs, "cities" => $cities->body->data, "data" => ["status_laporan" => $statusLaporan, "status_jalan" => $statusJalan]]);
    }

    public function kelolaPeta(Request $request)
    {
        return view('pages.dashboard.under-construction', ["title" => "Kelola Peta", "active_menu" => "kelola-peta"]);
    }
}
