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

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User", "active_menu" => "kelola-user", "url" => $url]);
    }

    public function getUserData(Request $request)
    {
        $service = new UserService;
        $users = $service->getAll($request->getQueryString());

        return response()->json($users);
    }
}
