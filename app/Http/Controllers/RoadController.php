<?php

namespace App\Http\Controllers;

use App\Services\CityService;
use App\Services\RoadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RoadController extends Controller
{
    public function index(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/roads";
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Kelola Peta Jalan',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.roads.daftar-jalan', ["title" => "Kelola Peta Jalan", "active_menu" => "kelola-peta", 'breadcrumbs' => $breadcrumbs, "url" => $url]);
    }

    public function detail(Request $request, $id)
    {
        $service = new RoadService;
        $response = $service->getById($id);
        $city_service = new CityService;
        $cities = $city_service->getAll();
        $types = [
            ["title" => "Jalan Kota/Kabupaten", "value" => "city"],
            ["title" => "Jalan Provinsi", "value" => "provinsi"],
            ["title" => "Jalan Nasional", "value" => "nasional"],
            ["title" => "Wilayah", "value" => "area"]
        ];

        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Kelola Peta Jalan',
                'link' => '/dashboard/kelola-peta'
            ],
            [
                "label" => 'Detail',
                'link' => ''
            ],
        ];

        return view('pages.dashboard.roads.detail-jalan', ["title" => "Detail Peta Jalan",  'breadcrumbs' => $breadcrumbs, "active_menu" => "kelola-peta", "types" => $types, "cities" => $cities->body->data, "data" => $response]);
    }

    public function update(Request $request)
    {
        $service = new RoadService;
        $response = $service->update($request, $request->id);
        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Informasi profil berhasil diubah");
    }

    // Data Purposes

    public function getDataRoads(Request $request)
    {
        $service = new RoadService;
        $response = $service->getAll($request->getQueryString());

        return response()->json($response);
    }
}
