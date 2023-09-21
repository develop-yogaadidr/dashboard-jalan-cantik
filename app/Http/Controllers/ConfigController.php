<?php

namespace App\Http\Controllers;

use App\Services\ConfigService;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function kelolaAi(Request $request)
    {
        $service = new ConfigService;
        $response = $service->getAll();

        return view('pages.dashboard.konfigurasi-ai', ["title" => "Kelola AI", "active_menu" => "kelola-ai", "data" => $response]);
    }

    public function updateAi(Request $request)
    {
        $service = new ConfigService;
        $input = $request::post();
        array_shift($input);

        $response = $service->updateBatch($input);

        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Konfigurasi berhasil diubah");
    }
}
