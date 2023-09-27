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
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Daftar User',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User", "active_menu" => "daftar-user", 'breadcrumbs' => $breadcrumbs, "url" => $url]);
    }

    public function getUserAdmin(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/user?main_filter[]=role,Admin";
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Daftar User Admin',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User Admin", "active_menu" => "user-admin", "url" => $url]);
    }

    public function getUserPelapor(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/user?main_filter[]=role,User";
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Daftar User Pelapor',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User Pelapor", "active_menu" => "user-pelapor", "url" => $url]);
    }

    public function getAdminRoles(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/role-admin?join_count=admin_city";
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Daftar Role Admin',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.daftar-role-admin', ["title" => "Daftar Admin Role", "active_menu" => "admin-role", "url" => $url]);
    }

    public function getUserById(Request $request, $id)
    {
        $service = new UserService;
        $response = $service->getById($id);

        return view('pages.dashboard.detail-user', ["title" => "Detail User", "active_menu" => "kelola-user", "data" => $response]);
    }

    public function getAdminRoleById(Request $request, $id)
    {
        $service = new UserService;
        $response = $service->getAdminRoleById($id);

        return view('pages.dashboard.detail-user', ["title" => "Detail User", "active_menu" => "admin-role", "data" => $response]);
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

    public function getAdminRolesData(Request $request)
    {
        $service = new UserService;
        $users = $service->getAllAdminRole($request->getQueryString());

        return response()->json($users);
    }
}
