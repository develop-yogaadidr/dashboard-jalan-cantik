<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getListOfFilterData($admin = false)
    {
        $city_service = new CityService;
        $query = "per_page=all&sort=name,asc";
        if ($admin) {
            $cities = $city_service->getAll($query);
        } else {
            $cities = $city_service->getAllCities($query);
        }

        $statuses = [['label' => 'Semua Status Laporan', 'value' => 'all'], ['label' => 'Diterima', 'value' => 'Diterima'], ['label' => 'Proses Pengerjaan', 'value' => 'Proses Pengerjaan'], ['label' => 'Ditolak', 'value' => 'Ditolak'], ['label' => 'Ditunda', 'value' => 'Ditunda'], ['label' => 'Selesai', 'value' => 'Selesai']];
        $types = [['label' => 'Semua Kasus Jalan', 'value' => 'all'], ['label' => 'Jalan Rusak', 'value' => 'Jalan Rusak'], ['label' => 'Saluran Drainase', 'value' => 'Saluran Drainase'], ['label' => 'Gorong-Gorong', 'value' => 'Gorong-Gorong'], ['label' => 'Bahu Jalan', 'value' => 'Bahu Jalan'], ['label' => 'Pohon Tumbang', 'value' => 'Pohon Tumbang'], ['label' => 'Bencana', 'value' => 'Bencana'], ['label' => 'Genangan Air', 'value' => 'Genangan Air'], ['label' => 'Lainnya', 'value' => 'Lainnya']];
        $status_jalan = [['label' => 'Semua Status Jalan', 'value' => 'all'], ['label' => 'Jalan Tol', 'value' => 'Tol'], ['label' => 'Jalan Nasional', 'value' => 'Nasional'], ['label' => 'Jalan Provinsi', 'value' => 'Provinsi'], ['label' => 'Jalan Kabupaten/Kota', 'value' => 'Kabupaten/Kota'], ['label' => 'Jalan Desa', 'value' => 'Desa']];
        $months = [['label' => 'Semua Bulan', 'value' => 'all'], ['label' => "Januari", 'value' => '1'], ['label' => "Februari", 'value' => '2'], ['label' => "Maret", 'value' => '3'], ['label' => "April", 'value' => '4'], ['label' => "Mei", 'value' => '5'], ['label' => "Juni", 'value' => '6'], ['label' => "Juli", 'value' => '7'], ['label' => "Agustus", 'value' => '8'], ['label' => "September", 'value' => '9'], ['label' => "Oktober", 'value' => '10'], ['label' => "November", 'value' => '11'], ['label' => "Desember", 'value' => '12']];
        $wilayah = $city_service->getAllWilayah("per_page=all&filter[]=role_type,bpj,sort=name,asc");

        $current_year = Date('Y');
        $years = [['label' => 'Semua Tahun Laporan', 'value' => 'all']];

        for ($i = 0; $i < 4; $i++) {
            array_push($years, ['label' => $current_year - $i, 'value' => $current_year - $i]);
        }

        return [
            "statuses" => $statuses,
            "types" => $types,
            "years" => $years,
            "months" => $months,
            "cities" => $cities->body,
            "wilayah" => $wilayah->body,
            "status_jalan" => $status_jalan
        ];
    }

    protected function populateFilter(Request $request)
    {
        $data = [
            "selected_year" => $request->selected_year ?? "all",
            "selected_month" => $request->selected_month ?? "all",
            "selected_status" => $request->selected_status ?? "all",
            "selected_city" => $request->selected_city ?? "all",
            "selected_kasus" => $request->selected_kasus ?? "all",
            "selected_wilayah" => $request->selected_wilayah ?? "all",
            "selected_status_jalan" => $request->selected_status_jalan ?? "all"
        ];

        $filter_year = $data['selected_year'] == "all" ? "" : "&period=" . $data['selected_year'] . ",reports.created_at";
        $filter_month = $data['selected_month'] == "all" ? "" : "&period_month=" . $data['selected_month'] . ",reports.created_at";
        $filter_status = $data['selected_status'] == "all" ? "" : "&main_filter[]=reports.status," . $data['selected_status'];
        $filter_kasus = $data['selected_kasus'] == "all" ? "" : "&main_filter[]=reports.type," . $data['selected_kasus'];
        $filter_city = $data['selected_city'] == "all" ? "" : "&main_filter[]=reports.city_id," . $data['selected_city'];
        $filter_wilayah = $data['selected_wilayah'] == "all" ? "" : "&wilayah=" . $data['selected_wilayah'];
        $filter_status_jalan = $data['selected_status_jalan'] == "all" ? "" : "&main_filter[]=reports.status_jalan," . $data['selected_status_jalan'];

        $filtered = array_values(array_filter($data, fn ($value, $key) => $value != 'all', ARRAY_FILTER_USE_BOTH));
        $filter_counter = sizeof($filtered);

        return  [
            "selected_data" => $data,
            "year" => $filter_year,
            "month" => $filter_month,
            "status" => $filter_status,
            "city" => $filter_city,
            "wilayah" => $filter_wilayah,
            "kasus" => $filter_kasus,
            "status_jalan" => $filter_status_jalan,
            "counter" => $filter_counter
        ];
    }
}
