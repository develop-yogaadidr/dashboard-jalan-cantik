<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new ReportRepository();
        $responseDto = $this->buildResponse($repository->getAllData($queryString));

        return $responseDto;
    }

    public function getById($id, $queryString)
    {
        $repository = new ReportRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id, $queryString));

        return $responseDto;
    }

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