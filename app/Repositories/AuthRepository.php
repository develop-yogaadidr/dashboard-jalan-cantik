<?php

namespace App\Repositories;

use App\Models\Dtos\LoginRequestDto;
use Illuminate\Support\Facades\Http;

class AuthRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/auth", "");
    }

    public function auth(LoginRequestDto $loginDto)
    {
        $response = Http::post($this->base_url . '/login', $loginDto);

        return $response;
    }

    public function profile()
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/profile');

        return $response;
    }

    public function refresh()
    {
        $response = Http::withToken($this->token)->post($this->base_url . '/refresh');

        return $response;
    }

    public function logout()
    {
        $response = Http::withToken($this->token)->post($this->base_url . '/logout');

        return $response;
    }
}
