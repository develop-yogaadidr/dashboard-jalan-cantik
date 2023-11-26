<?php

namespace App\Services;

use App\Repositories\ProgressReporitory;
use App\Repositories\PublicReportRepository;
use App\Repositories\ReportRepository;
use Illuminate\Http\Request;

class ReportService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new ReportRepository();
        $responseDto = $this->buildResponse($repository->getAllData($queryString));

        return $responseDto;
    }

    public function getAllPublic($queryString = "")
    {
        $repository = new PublicReportRepository();
        $responseDto = $this->buildResponse($repository->getAll($queryString));

        return $responseDto;
    }

    public function getById($id, $queryString = "")
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

    public function createProgress(Request $request)
    {
        $repository = new ProgressReporitory();
        $responseDto = $this->buildResponse($repository->createProgress($request));

        return $responseDto;
    }

    // PUBLIC

    public function getCounterTotalLaporan()
    {
        $repository = new PublicReportRepository();
        $responseDto = $this->buildResponse($repository->getCounterTotalLaporan());

        return $responseDto;
    }

    public function getCounterLaporanDiterimaAi()
    {
        $repository = new PublicReportRepository();
        $responseDto = $this->buildResponse($repository->getCounterLaporanDiterimaAi());

        return $responseDto;
    }

    public function getCounterKinerja($status_jalan)
    {
        $repository = new PublicReportRepository();
        $responseDto = $this->buildResponse($repository->getCounterKinerja($status_jalan));

        return $responseDto;
    }
}
