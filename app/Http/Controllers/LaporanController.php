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
                'link' => '/dashboard/laporan?'.session('link-laporan-querystring')
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

        return redirect(session('link-laporan') . '?'. session('link-laporan-querystring'))->with('success', "Laporan berhasil diperbarui");
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
        $city_service = new CityService;
        $service = new ReportService;
        $counter_status = $service->getCounterStatusLaporan();
        $cities = $city_service->getAll();

        $url = URL::to('/') . "/dashboard/data/laporan?join=user,progress.updater" . $filter['year'] . $filter['city'] . $filter['status'] . $filter['kasus'] . $filter['status_jalan'];
        session()->put('link-laporan', $request->url());
        session()->put('link-laporan-querystring', $request->getQueryString());

        $statuses = [['label' => 'Semua Status Laporan', 'value' => 'all'], ['label' => 'Diterima', 'value' => 'Diterima'], ['label' => 'Proses Pengerjaan', 'value' => 'Proses Pengerjaan'], ['label' => 'Ditolak', 'value' => 'Ditolak'], ['label' => 'Ditunda', 'value' => 'Ditunda'], ['label' => 'Selesai', 'value' => 'Selesai']];
        $types = [['label' => 'Semua Kasus Jalan', 'value' => 'all'], ['label' => 'Jalan Rusak', 'value' => 'Jalan Rusak'], ['label' => 'Saluran Drainase', 'value' => 'Saluran Drainase'], ['label' => 'Gorong-Gorong', 'value' => 'Gorong-Gorong'], ['label' => 'Bahu Jalan', 'value' => 'Bahu Jalan'], ['label' => 'Pohon Tumbang', 'value' => 'Pohon Tumbang'], ['label' => 'Bencana', 'value' => 'Bencana'], ['label' => 'Genangan Air', 'value' => 'Genangan Air'], ['label' => 'Lainnya', 'value' => 'Lainnya']];
        $status_jalan = [['label' => 'Semua Status Jalan', 'value' => 'all'], ['label' => 'Jalan Tol', 'value' => 'Tol'], ['label' => 'Jalan Nasional', 'value' => 'Nasional'], ['label' => 'Jalan Provinsi', 'value' => 'Provinsi'], ['label' => 'Jalan Kabupaten/Kota', 'value' => 'Kabupaten/Kota'], ['label' => 'Jalan Desa', 'value' => 'Desa']];

        $current_year = Date('Y');
        $years = [['label' => 'Semua Tahun Laporan', 'value' => 'all']];

        for ($i = 0; $i < 4; $i++) {
            array_push($years, ['label' => $current_year - $i, 'value' => $current_year - $i]);
        }

        return view('pages.dashboard.laporan.daftar-laporan', [
            "title" => "Daftar Laporan ", "active_menu" => "dashboard", "url" => $url,
            "counter_status" => $counter_status,
            "filter_counter" => $filter['counter'],
            "breadcrumbs" => $breadcrumbs,
            "filter" => $filter['selected_data'], "list_of_data" =>
            [
                "statuses" => $statuses,
                "types" => $types,
                "years" => $years,
                "cities" => $cities->body->data,
                "status_jalan" => $status_jalan
            ]
        ]);
    }

    // Data Purposes

    public function getDataLaporan(Request $request)
    {
        $service = new ReportService;
        $response = $service->getAll($request->getQueryString());

        return response()->json($response);
    }

    private function populateFilter(Request $request)
    {
        $selected_year = $request->selected_year ?? "all";
        $selected_status = $request->selected_status ?? "all";
        $selected_city = $request->selected_city ?? "all";
        $selected_kasus = $request->selected_kasus ?? "all";
        $selected_status_jalan = $request->selected_status_jalan ?? "all";

        $filter_year = $selected_year == "all" ? "" : "&period=" . $selected_year . ",reports.created_at";
        $filter_status = $selected_status == "all" ? "" : "&main_filter[]=reports.status," . $selected_status;
        $filter_kasus = $selected_kasus == "all" ? "" : "&main_filter[]=reports.type," . $selected_kasus;
        $filter_city = $selected_city == "all" ? "" : "&main_filter[]=reports.city_id," . $selected_city;
        $filter_status_jalan = $selected_status_jalan == "all" ? "" : "&main_filter[]=reports.status_jalan," . $selected_status_jalan;

        $filter_counter = 0;
        $filter_counter += $selected_year != 'all' ? 1 : 0;
        $filter_counter += $selected_city != 'all' ? 1 : 0;
        $filter_counter += $selected_status_jalan != 'all' ? 1 : 0;
        $filter_counter += $selected_kasus != 'all' ? 1 : 0;

        return  [
            "selected_data" => [
                "selected_year" => $selected_year,
                "selected_status" => $selected_status,
                "selected_city" => $selected_city,
                "selected_kasus" => $selected_kasus,
                "selected_status_jalan" => $selected_status_jalan
            ],
            "year" => $filter_year,
            "status" => $filter_status,
            "city" => $filter_city,
            "kasus" => $filter_kasus,
            "status_jalan" => $filter_status_jalan,
            "counter" => $filter_counter
        ];
    }
}
