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

    protected function getListOfFilterData()
    {
        $city_service = new CityService;
        $cities = $city_service->getAll();

        $statuses = [['label' => 'Semua Status Laporan', 'value' => 'all'], ['label' => 'Diterima', 'value' => 'Diterima'], ['label' => 'Proses Pengerjaan', 'value' => 'Proses Pengerjaan'], ['label' => 'Ditolak', 'value' => 'Ditolak'], ['label' => 'Ditunda', 'value' => 'Ditunda'], ['label' => 'Selesai', 'value' => 'Selesai']];
        $types = [['label' => 'Semua Kasus Jalan', 'value' => 'all'], ['label' => 'Jalan Rusak', 'value' => 'Jalan Rusak'], ['label' => 'Saluran Drainase', 'value' => 'Saluran Drainase'], ['label' => 'Gorong-Gorong', 'value' => 'Gorong-Gorong'], ['label' => 'Bahu Jalan', 'value' => 'Bahu Jalan'], ['label' => 'Pohon Tumbang', 'value' => 'Pohon Tumbang'], ['label' => 'Bencana', 'value' => 'Bencana'], ['label' => 'Genangan Air', 'value' => 'Genangan Air'], ['label' => 'Lainnya', 'value' => 'Lainnya']];
        $status_jalan = [['label' => 'Semua Status Jalan', 'value' => 'all'], ['label' => 'Jalan Tol', 'value' => 'Tol'], ['label' => 'Jalan Nasional', 'value' => 'Nasional'], ['label' => 'Jalan Provinsi', 'value' => 'Provinsi'], ['label' => 'Jalan Kabupaten/Kota', 'value' => 'Kabupaten/Kota'], ['label' => 'Jalan Desa', 'value' => 'Desa']];

        $current_year = Date('Y');
        $years = [['label' => 'Semua Tahun Laporan', 'value' => 'all']];

        for ($i = 0; $i < 4; $i++) {
            array_push($years, ['label' => $current_year - $i, 'value' => $current_year - $i]);
        }

        return [
            "statuses" => $statuses,
            "types" => $types,
            "years" => $years,
            "cities" => $cities->body->data,
            "status_jalan" => $status_jalan
        ];
    }

    protected function populateFilter(Request $request)
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
        $filter_counter += $selected_status != 'all' ? 1 : 0;

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
