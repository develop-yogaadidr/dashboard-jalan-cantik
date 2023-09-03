<?php

namespace App\Services;

use App\Models\Dtos\LoginRequestDto;
use App\Models\Dtos\ResponseDto;
use App\Repositories\AuthRepository;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class AuthService
{
    public function login(Request $request)
    {
        $repository = new AuthRepository();
        $dto = new LoginRequestDto();

        $dto->username = $request['username'];
        $dto->password = $request['password'];

        $responseDto = $this->buildResponse($repository->auth($dto));

        if ($responseDto->ok()) {
            $request->session()->put('auth', $responseDto->data);
        }

        return $responseDto;
    }

    public function logout(Request $request)
    {
        $repository = new AuthRepository();
        $responseDto = $this->buildResponse($repository->logout());

        if ($responseDto->ok()) {
            $request->session()->forget('auth');
        }

        return $responseDto;
    }


    private function buildResponse($response)
    {
        $responseDto = new ResponseDto();
        $responseBody = $response->object();

        $responseDto->status_code = $response->status();
        $responseDto->message = $responseBody->message ?? "";

        if ($response->ok()) {
            $responseDto->data = $responseBody;
        }

        return $responseDto;
    }
}
