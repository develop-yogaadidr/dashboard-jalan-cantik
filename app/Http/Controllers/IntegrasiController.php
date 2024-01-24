<?php

namespace App\Http\Controllers;

use App\Services\IntegrationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class IntegrasiController extends Controller
{
    public function index(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/integrations";
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Kelola Integrasi',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.integrasi.daftar-integrator', ["title" => "Kelola Integrasi", "active_menu" => "kelola-integrasi", 'breadcrumbs' => $breadcrumbs, "url" => $url]);
    }

    public function detail(Request $request, $id)
    {
        $service = new IntegrationService;
        $response = $service->getById($id, "join=user");

        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Kelola Integrasi',
                'link' => '/dashboard/kelola-integrasi'
            ],
            [
                "label" => 'Detail',
                'link' => ''
            ],
        ];

        return view('pages.dashboard.integrasi.detail-integrator', ["title" => "Detail Integrator",  'breadcrumbs' => $breadcrumbs, "active_menu" => "kelola-integrasi", "data" => $response]);
    }

    public function create(Request $request)
    {
        return redirect()->back()->with('success', "Data integrasi berhasil ditambahkan");
    }

    public function update(Request $request)
    {
        $service = new IntegrationService;
        $response = $service->update($request, $request->id);
        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Data integrasi berhasil diubah");
    }

    // Integrasi

    public function integrasi(Request $request)
    {
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Setting Integrasi',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.integrasi.integrasi', ["title" => "Setting Integrasi",  'breadcrumbs' => $breadcrumbs, "active_menu" => "integrasi", "data" => session("profile")]);
    }

    public function integrasiUpdate(Request $request)
    {
        $profile = session("profile");
        if ($profile == null || ($profile != null && $profile->integrasi == null)) {
            return redirect()->back()->with('warning', "Unauthorized");
        }

        $service = new UserService;
        $response = $service->updateMyIntegrationData($request);
        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Data integrasi berhasil diubah");
    }

    public function regenerateKey(Request $request)
    {
        $service = new UserService;
        $response = $service->regenerateMyApiKey($request);
        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Data integrasi berhasil diubah");
    }

    // Data Purposes

    public function gatDataIntegrasi(Request $request)
    {
        $service = new IntegrationService();
        $response = $service->getAll($request->getQueryString());

        return response()->json($response);
    }
}
