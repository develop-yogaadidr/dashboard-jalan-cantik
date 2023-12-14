<?php

namespace App\Services;

use App\Models\Dtos\RoadsRequestDto;
use App\Repositories\RoadRepository;
use Illuminate\Http\Request;

class RoadService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new RoadRepository();
        $responseDto =$repository->getAllData($queryString)->object();

        return $responseDto;
    }

    public function getById($id)
    {
        $repository = new RoadRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id));

        return $responseDto;
    }

    public function create(Request $request)
    {
        $dto = $this->generateDto($request);

        $repository = new RoadRepository();
        $responseDto = $this->buildResponse($repository->createData($request, $dto));

        return $responseDto;
    }

    public function update(Request $request, $id)
    {
        $dto = $this->generateDto($request);

        $repository = new RoadRepository();
        $responseDto = $this->buildResponse($repository->updateData($request, $id, $dto));

        return $responseDto;
    }

    private function generateDto(Request $request)
    {
        $entity = [
            "name" => $request->name,
            "type" => $request->type,
            "city_id" => $request->type != 'city' ? null : $request->city_id
        ];

        return $entity;
    }
}
