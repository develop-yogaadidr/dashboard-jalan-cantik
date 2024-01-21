<?php

namespace App\Services;

use App\Models\Dtos\LoginRequestDto;
use App\Models\Dtos\ResponseDto;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthService extends ServiceBase
{
    public function login(Request $request)
    {
        $repository = new AuthRepository();
        $dto = new LoginRequestDto();

        $dto->email = $request['email'];
        $dto->password = $request['password'];

        $responseDto = $this->buildResponse($repository->auth($dto));

        if ($responseDto->ok()) {
            $request->session()->put('auth', $responseDto->body);

            $profile = $this->profile();

            $name = explode(" ", $profile->body->name);
            $profile->body->initial = ($name[0][0] ?? "") . ($name[1][0] ?? "");

            $admin_roles = ['Admin', 'Admin Provinsi', 'Admin Balai Nasional', 'Admin Balai Provinsi', 'Admin Kab/Kota'];
            if (!in_array($profile->body->role, $admin_roles)) {
                // if user role is not listed above
                $request->session()->forget('auth');

                $response = new ResponseDto();
                $response->body = null;
                $response->message = "Admin dengan email dan password tersebut tidak ditemukan";
                $response->status_code = 404;

                return $response;
            }

            $request->session()->put('profile', $profile->body);
        }

        return $responseDto;
    }

    public function profile()
    {
        $repository = new AuthRepository();
        $responseDto = $this->buildResponse($repository->profile());

        return $responseDto;
    }

    public function logout(Request $request)
    {
        $repository = new AuthRepository();
        $responseDto = $this->buildResponse($repository->logout());

        if ($responseDto->ok()) {
            $request->session()->forget('auth');
            $request->session()->forget('profile');
        }

        return $responseDto;
    }
}
