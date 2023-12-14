<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.dashboard.profile.profile', ["title" => "Profile User", "active_menu" => ""]);
    }

    public function updateProfile(Request $request)
    {
        $service = new UserService;
        $response = $service->updateProfile($request);
        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Informasi profil berhasil diubah");
    }
}
