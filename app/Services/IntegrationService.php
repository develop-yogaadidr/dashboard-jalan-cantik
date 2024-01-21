<?php

namespace App\Services;

use App\Repositories\IntegrationRepository;
use Illuminate\Http\Request;

class IntegrationService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new IntegrationRepository();
        $responseDto = $repository->getAllData($queryString)->object();

        return $responseDto;
    }

    public function getById($id, $queryString = "")
    {
        $repository = new IntegrationRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id, $queryString));

        return $responseDto;
    }

    public function update(Request $request, $id)
    {
        $dto = [
            "name" => $request->name,
            "description" => $request->description,
            "callback_url" => $request->callback_url,
        ];

        $repository = new IntegrationRepository();
        $responseDto = $this->buildResponse($repository->update($id, $dto));

        return $responseDto;
    }
}
