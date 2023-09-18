<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginProcess(Request $request)
    {
        $service = new AuthService;
        $response = $service->login($request);

        if ($response->ok()) {
            return redirect('dashboard');
        }else{
            return redirect('login');
        }
    }

    public function logoutProcess(Request $request)
    {
        $service = new AuthService;
        $response = $service->logout($request);

        if ($response->ok()) {
            return redirect('/');
        }else{
            return redirect('dashboard');
        }
    }
}
