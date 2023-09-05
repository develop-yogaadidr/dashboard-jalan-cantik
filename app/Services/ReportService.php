<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService extends ServiceBase
{
    public function getCounterStatusLaporan()
    {
        $repository = new ReportRepository();
        $responseDto = $this->buildResponse($repository->getCounterStatusLaporan());

        return $responseDto;
    }

    public function getCounterStatusJalan()
    {
        $repository = new ReportRepository();
        $responseDto = $this->buildResponse($repository->getCounterStatusJalan());

        return $responseDto;
    }

    public function getCounterKasusJalan()
    {
        $repository = new ReportRepository();
        $responseDto = $this->buildResponse($repository->getCounterKasusJalan());

        return $responseDto;
    }
}