<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/users", "");
    }

    public function getByRole($role, $queryString = "")
    {
        $response = Http::withToken($this->token)->get($this->base_url . "/" . $role . "?" . $queryString);
        
        return $response;
    }
}
