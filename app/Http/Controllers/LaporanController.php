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

        return view('pages.dashboard.laporan.detail-laporan', ["title" => "Laporan Detail", "active_menu" => "laporan-masuk", "data" => $response]);
    }

    public function prosesLaporan(Request $request, $id, $status)
    {
        $service = new ReportService;
        $response = $service->getById($id);

        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Laporan',
                'link' => '/dashboard/laporan?' . session('link-laporan-querystring')
            ],
            [
                "label" => 'Proses Laporan',
                'link' => ''
            ],
        ];

        return view('pages.dashboard.laporan.proses-laporan', ["title" => "Laporan " . $status, "breadcrumbs" => $breadcrumbs, "active_menu" => "laporan-masuk", "data" => $response, "status" => $status]);
    }

    public function createProsesLaporan(Request $request, $id, $status)
    {
        $service = new ReportService;
        $request->request->add(['report_id' => $id]);
        $request->request->add(['status' => $status]);

        $response = $service->createProgress($request);

        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect(session('link-laporan') . '?' . session('link-laporan-querystring'))->with('success', "Laporan berhasil diperbarui");
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
                'link' => '/dashboard'
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

        return view('pages.dashboard.laporan.daftar-laporan-status', ["title" => "Laporan Masuk Berdasarkan Status Jalan", 'breadcrumbs' => $breadcrumbs, "active_menu" => "status-jalan", "cities" => $cities->body->data, "data" => $response]);
    }

    public function kasusJalan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getCounterKasusJalan();
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
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

        return view('pages.dashboard.laporan.daftar-laporan-kasus', ["title" => "Laporan Masuk Berdasarkan Kasus Jalan", 'breadcrumbs' => $breadcrumbs, "active_menu" => "kasus-jalan", "data" => $response]);
    }

    public function daftarLaporanByStatus(Request $request)
    {
        if (!isset($request->selected_status)) {
            $request['selected_status'] = "Diterima";
        }

        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Laporan',
                'link' => ''
            ]
        ];

        $filter = $this->populateFilter($request);
        $service = new ReportService;
        $counter_status = $service->getCounterStatusLaporan();

        $url = URL::to('/') . "/dashboard/data/laporan?join=user,progress.updater" . $filter['year'] . $filter['city'] . $filter['status'] . $filter['kasus'] . $filter['status_jalan'];
        session()->put('link-laporan', $request->url());
        session()->put('link-laporan-querystring', $request->getQueryString());

        return view('pages.dashboard.laporan.daftar-laporan', [
            "title" => "Daftar Laporan ", "active_menu" => "dashboard", "url" => $url,
            "counter_status" => $counter_status,
            "breadcrumbs" => $breadcrumbs,
            "filter_counter" => $filter['counter'],
            "filter" => $filter['selected_data'],
            "list_of_data" => $this->getListOfFilterData(true)
        ]);
    }

    // Data Purposes

    public function getDataLaporan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getAll($request->getQueryString());

        return response()->json($response);
    }
}
