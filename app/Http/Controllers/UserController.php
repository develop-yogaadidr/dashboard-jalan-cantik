<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $service = new UserService;
        $users = $service->getAll();

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User", "active_menu" => "kelola-user", "data" => $users]);
    }

    public function getUserData(Request $request)
    {
        $service = new UserService;
        $users = $service->getAll();

        return response()->json($users);
    }
}
