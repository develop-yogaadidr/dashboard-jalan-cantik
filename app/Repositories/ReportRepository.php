<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class ReportRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/reports", "");
    }

    public function getCounterStatusLaporan()
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/counter');

        return $response;
    }

    public function getCounterStatusJalan()
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/counter/status-jalan');

        return $response;
    }
    
    public function getCounterKasusJalan()
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/counter/type');

        return $response;
    }
}