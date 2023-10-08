<?php

namespace App\Services;

use App\Models\Dtos\LoginRequestDto;
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
