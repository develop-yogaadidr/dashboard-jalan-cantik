<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\Services\ReportService;
use App\Services\RoadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $service = new ReportService();

        $road_service = new RoadService;
        $cities = $road_service->getAll("filter[]=type,city&per_page=all&sort=id,asc");
        $nasional_provinsi = $road_service->getAll("filter[]=type,nasional,OR&filter[]=type,provinsi,OR&per_page=all&sort=id,asc");
        $area = $road_service->getAll("filter[]=type,area&per_page=all&sort=id,asc");

        $counter_total_laporan = $service->getCounterTotalLaporan();
        $counter_laporan_publik = $service->getCounterLaporanDiterimaAi();
        return view('pages.public.home', ["title" => "Beranda", "active_menu" => "beranda", "cities" => $cities, "area" => $area, "nasional_provinsi" => $nasional_provinsi, "counter" => ["total" => $counter_total_laporan, "publik" => $counter_laporan_publik]]);
    }

    public function tentang(Request $request)
    {
        return view('pages.public.tentang', ["title" => "Tentang Jalan Cantik", "active_menu" => "tentang"]);
    }

    public function laporanMasuk(Request $request)
    {
        $filter = $this->populateFilter($request);
        $url = env("SERVER_URL", '') . '/reports?join=user' . $filter['wilayah'] . $filter['year'] . $filter['month']  . $filter['city'] . $filter['status'] . $filter['kasus'] . $filter['status_jalan'];

        return view('pages.public.laporan.daftar-laporan', [
            "title" => "Laporan Masuk",
            "url" => $url,
            "filter_counter" => $filter['counter'],
            "filter" => $filter['selected_data'],
            "list_of_data" => $this->getListOfFilterData()
        ]);
    }

    public function detailLaporanMasuk(Request $request, $id)
    {
        $service = new ReportService;
        $queryString = "?join=user,city,progress.updater";
        $response = $service->getById($id, $queryString);

        return view('pages.public.laporan.detail-laporan', ["title" => "Detail Laporan", "data" => $response]);
    }

    public function laporanDiterimaAi(Request $request)
    {
        $status_jalans = ["Tol", "Nasional", "Provinsi", "Kabupaten/Kota", "Desa"];
        $cards = [];
        foreach ($status_jalans as $jalan) {
            $target = URL::to('/') . '/laporan-masuk?selected_status_jalan=' . $jalan;
            if ($jalan == "Provinsi" || $jalan == "Desa" || $jalan == "Kabupaten/Kota") {
                $target = URL::to('/') . '/laporan-diterima-ai/' . str_replace("/", "", $jalan);
            }

            array_push($cards, [
                'id' => 'card-jalan-' . strtolower(str_replace("/", "-", $jalan)),
                'title' => 'Jalan ' . $jalan,
                'data' => $jalan,
                'url' => str_replace("/", "", $jalan),
                'target' => $target
            ]);
        }

        $url = env("SERVER_URL", '') . '/public/reports/counter/diterima-ai';
        return view('pages.public.laporan.diterima-ai', ["title" => "Laporan Kerusakan Diterima", 'url' => $url, "cards" => $cards]);
    }

    public function laporanDiterimaAiProvinsi(Request $request)
    {
        $city_service = new CityService;
        $wilayah = $city_service->getAllWilayah("per_page=all&filter[]=role_type,bpj&sort=name,asc");
        $cards = [];

        foreach ($wilayah->body as $element) {
            $target = URL::to('/') . '/laporan-masuk?selected_status_jalan=Provinsi&selected_wilayah=' . $element->id;
            array_push($cards, [
                'id' => 'card-wilayah-' . $element->id,
                'title' => 'Jalan ' . $element->name,
                'data' => $element->id,
                'url' => "Provinsi/bpj/" . $element->id,
                'target' => $target
            ]);
        }

        $url = env("SERVER_URL", '') . '/public/reports/counter/diterima-ai';
        return view('pages.public.laporan.diterima-ai', ["title" => "Laporan Kerusakan Diterima", "subtitle" => "Jalan Provinsi", 'url' => $url, "cards" => $cards]);
    }

    public function laporanDiterimaAiByKota(Request $request)
    {
        $city_service = new CityService;
        $cities = $city_service->getAllCities("per_page=all&sort=id,asc");
        $cards = [];
        $route = Route::getCurrentRoute()->getName();
        $status_jalan = $route == "laporan-diterima-ai-kabupaten-kota" ? "Kabupaten/Kota" : "Desa";

        foreach ($cities->body as $element) {
            $target = URL::to('/') . '/laporan-masuk?selected_status_jalan=' . $status_jalan . '&selected_city=' . $element->id;
            array_push($cards, [
                'id' => 'card-wilayah-' . $element->id,
                'title' => $element->name,
                'data' => $element->id,
                'url' => str_replace("/", "", $status_jalan) . "/city/" . $element->id,
                'target' => $target
            ]);
        }

        $url = env("SERVER_URL", '') . '/public/reports/counter/diterima-ai';
        $subtitle = $route == "laporan-diterima-ai-kabupaten-kota"
            ? "Jalan Kabupaten/Kota" : "Jalan Desa";
        return view('pages.public.laporan.diterima-ai', ["title" => "Laporan Kerusakan Diterima", "subtitle" => $subtitle, 'url' => $url, "cards" => $cards]);
    }

    public function laporanDitolakAi(Request $request)
    {
        $filter = $this->populateFilter($request);
        $url = env("SERVER_URL", '') . '/public/reports/ditolak-ai?join=user' . $filter['wilayah'] . $filter['year'] . $filter['city'] . $filter['status'] . $filter['kasus'] . $filter['status_jalan'];

        return view('pages.public.laporan.daftar-laporan-ditolak', [
            "title" => "Laporan Ditolak AI",
            "url" => $url,
            "filter_counter" => $filter['counter'],
            "filter" => $filter['selected_data'],
            "list_of_data" => $this->getListOfFilterData()
        ]);
    }

    public function download(Request $request)
    {
        return view('pages.public.download', ["title" => "Download", "active_menu" => "download"]);
    }

    public function kontak(Request $request)
    {
        return view('pages.public.kontak', ["title" => "Kontak Kami", "active_menu" => "kontak"]);
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
