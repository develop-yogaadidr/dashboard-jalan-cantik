<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

    public function download($queryString = "")
    {
        $date = date("d-m-Y H:i");
        $response = Http::withToken($this->token)->withHeaders([
            'accept' => 'application/octet-stream',
        ])->get($this->base_url . '/download' . "?" . $queryString);

        return response()->streamDownload(function () use ($response) {
            echo $response->getBody()->getContents();
        }, 'Export laporan '.$date.'.xlsx');
    }
}
