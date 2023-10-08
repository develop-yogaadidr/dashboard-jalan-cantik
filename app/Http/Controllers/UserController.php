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

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User Admin", "active_menu" => "user-admin", 'breadcrumbs' => $breadcrumbs,  "url" => $url]);
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

        return view('pages.dashboard.daftar-user', ["title" => "Daftar User Pelapor", "active_menu" => "user-pelapor", 'breadcrumbs' => $breadcrumbs, "url" => $url]);
    }

    public function getLevelAdmins(Request $request)
    {
        $url = URL::to('/') . "/dashboard/data/level-admin?join_count=admin_city";
        $breadcrumbs = [
            [
                "label" => 'Dashboard',
                'link' => '/dashboard'
            ],
            [
                "label" => 'Daftar Level Admin',
                'link' => ''
            ]
        ];

        return view('pages.dashboard.daftar-level-admin', ["title" => "Daftar Admin Role", "active_menu" => "level-admin", 'breadcrumbs' => $breadcrumbs,  "url" => $url]);
    }

    public function getUserById(Request $request, $id)
    {
        $service = new UserService;
        $response = $service->getById($id);

        if ($response->body->role == "User") {
            return view('pages.dashboard.detail-user', ["title" => "Detail User", "active_menu" => "kelola-user", "data" => $response]);
        } else {
            $roles = $service->getAllLevelAdmin("per_page=all");
            return view('pages.dashboard.detail-user-admin', ["title" => "Detail User", "active_menu" => "kelola-user", "data" => $response, "roles" => $roles]);
        }
    }

    public function updateUserAdmin(Request $request)
    {
        $input = $request->all();
        $service = new UserService;
        $response = $service->update($input);

        if (!$response->ok()) {
            return redirect()->back()->with('warning', $response->message);
        }

        return redirect()->back()->with('success', "Admin berhasil diubah");
    }

    public function getLevelAdminById(Request $request, $id)
    {
        $service = new UserService;
        $response = $service->getLevelAdminById($id);

        return view('pages.dashboard.detail-user', ["title" => "Detail User", "active_menu" => "level-admin", "data" => $response]);
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

    public function getLevelAdminsData(Request $request)
    {
        $service = new UserService;
        $roles = $service->getAllLevelAdmin($request->getQueryString());

        return response()->json($roles);
    }
}
