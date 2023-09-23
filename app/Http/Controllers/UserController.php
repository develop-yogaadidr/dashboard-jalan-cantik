<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/user";

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User", "active_menu" => "daftar-user", "url" => $url]);
    }

    public function getUserAdmin(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/user?main_filter[]=role,Admin";

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User", "active_menu" => "user-admin", "url" => $url]);
    }

    public function getUserPelapor(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/user?main_filter[]=role,User";

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User", "active_menu" => "user-pelapor", "url" => $url]);
    }

    public function getUserById(Request $request, $id)
    {
        $service = new UserService;
        $response = $service->getById($id);

        return view('pages.dashboard.detail-user', ["title" => "Detail User", "active_menu" => "kelola-user", "data" => $response]);
    }

    // Data Purposes

    public function getUserData(Request $request)
    {
        $service = new UserService;
        $users = $service->getAll($request->getQueryString());

        return response()->json($users);
    }

    public function getUserDataAdmin(Request $request)
    {
        $service = new UserService;
        $users = $service->getByRole("admin", $request->getQueryString());

        return response()->json($users);
    }

    public function getUserDataPelapor(Request $request)
    {
        $service = new UserService;
        $users = $service->getByRole("pelapor", $request->getQueryString());

        return response()->json($users);
    }
}
