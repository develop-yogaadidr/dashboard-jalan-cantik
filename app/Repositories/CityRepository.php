<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class CityRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/cities", "");
    }

    public function getAllCities($queryString = "")
    {
        $response = Http::withToken($this->token)->get($this->base_url . "/all?" . $queryString);

        return $response;
    }

    public function getAllWilayah($queryString = "")
    {
        $response = Http::withToken($this->token)->get($this->base_url . "/wilayah?" . $queryString);

        return $response;
    }
}
