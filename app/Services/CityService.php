<?php

namespace App\Services;

use App\Repositories\CityRepository;

class CityService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new CityRepository();
        $responseDto = $this->buildResponse($repository->getAllData($queryString));

        return $responseDto;
    }

    public function getAllCities($queryString = "")
    {
        $repository = new CityRepository();
        $responseDto = $this->buildResponse($repository->getAllCities($queryString));

        return $responseDto;
    }
}
