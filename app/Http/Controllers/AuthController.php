<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\CityService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('pages.public.login', ["title" => "Login"]);
    }

    public function loginDevelopment(Request $request)
    {
        $city_service = new CityService;
        $cities = $city_service->getAllCities("per_page=all&sort=id,asc");

        return view('pages.public.login-develop', ["title" => "Login"]);
    }

    public function loginDevelopmentProcess(Request $request)
    {
        if (env("APP_ENV", "production") != "local") {
            return redirect('login')->with('warning', "Unauthorized");
        }

        $users = [
            "admin_jaki" => [
                "email" => "adminnasional@mail.com",
                "password" => "Password2022"
            ],
            "admin_provinsi" => [
                "email" => "adminprovinsi@mail.com",
                "password" => "Password2022"
            ],
            "admin_kabupaten_kota" => [
                "email" => "dpupurbalingga@gmail.com",
                "password" => "purbalingga123"
            ],
        ];

        $service = new AuthService;
        $request['email'] = $users[$request['role']]['email'];
        $request['password'] = $users[$request['role']]['password'];
        $response = $service->login($request);

        if ($response->ok()) {
            return redirect('dashboard');
        } else {
            return redirect('login')->with('warning', $response->message);
        }
    }

    public function loginProcess(Request $request)
    {
        $service = new AuthService;
        $response = $service->login($request);

        if ($response->ok()) {
            return redirect('dashboard');
        } else {
            return redirect('login')->with('warning', $response->message);
        }
    }

    public function logoutProcess(Request $request)
    {
        $service = new AuthService;
        $response = $service->logout($request);

        if ($response->ok()) {
            return redirect('/');
        } else {
            return redirect('dashboard');
        }
    }
}
