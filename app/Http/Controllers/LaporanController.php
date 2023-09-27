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
        $city_service = new CityService;
        $cities = $city_service->getAll();

        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => 'dashboard'
            ],
            [
                "label" => 'Laporan Masuk',
                'link' => ''
            ],
            [
                "label" => 'Status Jalan',
                'link' => ''
            ],
        ];

        return view('pages.dashboard.laporan-status', ["title" => "Laporan Masuk Berdasarkan Status Jalan", 'breadcrumbs' => $breadcrumbs, "active_menu" => "status-jalan", "cities" => $cities->body->data, "data" => $response]);
    }

    public function kasusJalan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getCounterKasusJalan();
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => 'dashboard'
            ],
            [
                "label" => 'Laporan Masuk',
                'link' => ''
            ],
            [
                "label" => 'Kasus Jalan',
                'link' => ''
            ],
        ];

        return view('pages.dashboard.laporan-kasus', ["title" => "Laporan Masuk Berdasarkan Kasus Jalan", 'breadcrumbs' => $breadcrumbs, "active_menu" => "kasus-jalan", "data" => $response]);
    }

    public function daftarLaporanByStatusJalan(Request $request, $status, $city_id = null)
    {
        $filter = $this->populateFilter($request);
        $city_service = new CityService;
        $cities = $city_service->getAll();
        $breadcrumbs = $this->detailBreadcrumbs('Status Jalan', '/dashboard/laporan/status-jalan');

        $status = str_replace("-", "/", $status);

        $url = URL::to('/') . "/dashboard/data/laporan?join=city,user&main_filter[]=status_jalan," . $status . $filter['year'] . $filter['city'] . $filter['year'];

        return view('pages.dashboard.daftar-laporan', [
            "title" => "Daftar Laporan " . $status, "active_menu" => "status-jalan", 'breadcrumbs' => $breadcrumbs,  "url" => $url,
            "filter" => $filter['selected_data'], "cities" => $cities->body->data
        ]);
    }

    public function daftarLaporanByKasusJalan(Request $request, $kasus)
    {
        $filter = $this->populateFilter($request);
        $city_service = new CityService;
        $cities = $city_service->getAll();
        $breadcrumbs = $this->detailBreadcrumbs('Kasus Jalan', '/dashboard/laporan/kasus-jalan');

        $url = URL::to('/') . "/dashboard/data/laporan?join=city,user&main_filter[]=type," . $kasus . $filter['year'] . $filter['city'] . $filter['year'];

        return view('pages.dashboard.daftar-laporan', [
            "title" => "Daftar Laporan " . $kasus, "active_menu" => "kasus-jalan", 'breadcrumbs' => $breadcrumbs,  "url" => $url,
            "filter" => $filter['selected_data'], "cities" => $cities->body->data
        ]);
    }

    public function daftarLaporanByStatus(Request $request, $status)
    {
        $request['selected_status'] = $status;
        $filter = $this->populateFilter($request);
        $city_service = new CityService;
        $cities = $city_service->getAll();
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Laporan ',
                'link' => ''
            ],
            [
                "label" => 'Daftar',
                'link' => ''
            ],
        ];

        $url = URL::to('/') . "/dashboard/data/laporan?join=city,user&main_filter[]=status," . $status . $filter['year'] . $filter['city'] . $filter['year'];

        return view('pages.dashboard.daftar-laporan', [
            "title" => "Daftar Laporan ", "active_menu" => "dashboard", 'breadcrumbs' => $breadcrumbs,  "url" => $url,
            "filter" => $filter['selected_data'], "cities" => $cities->body->data
        ]);
    }

    // Data Purposes

    public function getDataLaporan(Request $request)
    {
        $service = new ReportService;
        $users = $service->getAll($request->getQueryString());

        return response()->json($users);
    }

    private function detailBreadcrumbs($menu, $link)
    {
        return [
            [
                "label" => 'Dashboard',
                'link' => '/'
            ],
            [
                "label" => 'Laporan Masuk',
                'link' => $link
            ],
            [
                "label" => $menu,
                'link' => $link
            ],
            [
                "label" => 'Daftar',
                'link' => ''
            ],
        ];
    }

    private function populateFilter(Request $request)
    {
        $selected_year = $request->selected_year ?? "all";
        $selected_status = $request->selected_status ?? "all";
        $selected_city = $request->selected_city ?? "all";

        $filter_year = $selected_year == "all" ? "" : "&period=" . $selected_year;
        $filter_status = $selected_status == "all" ? "" : "&main_filter[]=status," . $selected_status;
        $filter_city = $selected_city == "all" ? "" : "&main_filter[]=city_id," . $selected_city;

        return  [
            "selected_data" => [
                "selected_year" => $selected_year,
                "selected_status" => $selected_status,
                "selected_city" => $selected_city,
            ],
            "year" => $filter_year,
            "status" => $filter_status,
            "city" => $filter_city
        ];
    }
}
