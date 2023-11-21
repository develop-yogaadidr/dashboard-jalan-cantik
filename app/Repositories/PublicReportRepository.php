<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class PublicReportRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/public/reports", "");
    }

    public function getCounterTotalLaporan()
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/counter');

        return $response;
    }

    public function getCounterLaporanDiterimaAi()
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/counter/diterima-ai');

        return $response;
    }

    public function getCounterKinerja($status_jalan)
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/counter/diterima-ai/'. $status_jalan);

        return $response;
    }
}