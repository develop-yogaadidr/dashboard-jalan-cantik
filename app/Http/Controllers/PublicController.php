<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $service = new ReportService();
        $counter = $service->getCounterTotalLaporan();

        return view('pages.public.home', ["title" => "Beranda", "active_menu" => "beranda", "counter" => $counter]);
    }

    public function tentang(Request $request)
    {
        return view('pages.public.tentang', ["title" => "Tentang Jalan Cantik", "active_menu" => "tentang"]);
    }
    public function laporanMasuk(Request $request)
    {
        $filter = $this->populateFilter($request);
        $url = env("SERVER_URL", '') . '/reports?join=user' . $filter['year'] . $filter['city'] . $filter['status'] . $filter['kasus'] . $filter['status_jalan'];

        return view('pages.public.laporan.daftar-laporan', [
            "title" => "Laporan Masuk",
            "url" => $url,
            "filter_counter" => $filter['counter'],
            "filter" => $filter['selected_data'],
            "list_of_data" => $this->getListOfFilterData()
        ]);
    }

    public function laporanDiterimaAi(Request $request)
    {
        $service = new ReportService();
        $counter = $service->getCounterLaporanDiterimaAi();

        return view('pages.public.laporan.diterima-ai', ["title" => "Laporan Diterima AI", "data" => $counter]);
    }

    public function laporanDetailDiterimaAi(Request $request)
    {
        $url = env("SERVER_URL", '') . '/public/reports/counter/diterima-ai';

        return view('pages.public.laporan.diterima-ai-detail', ["title" => "Laporan Kerusakan Diterima", 'url' => $url]);
    }

    public function laporanDitolakAi(Request $request)
    {
        return view('pages.public.laporan.daftar-laporan', ["title" => "Laporan Ditolak AI"]);
    }

    public function download(Request $request)
    {
        return view('pages.public.download', ["title" => "Download", "active_menu" => "download"]);
    }

    public function kontak(Request $request)
    {
        return view('pages.public.kontak', ["title" => "Kontak", "active_menu" => "kontak"]);
    }

    public function privacyPolicy(Request $request)
    {
        return view('pages.public.privacy-policy', ["title" => "Privacy - Policy", "active_menu" => "privacy-policy"]);
    }

    // Data Purposes

    public function getDataKinerja(Request $request, $status_jalan)
    {
        $service = new ReportService;
        $response = $service->getCounterKinerja($status_jalan);

        return response()->json($response);
    }
}
