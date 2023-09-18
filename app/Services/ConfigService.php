<?php

namespace App\Services;

use App\Models\Dtos\ResponseDto;
use App\Repositories\ConfigRepository;

class ConfigService extends ServiceBase
{
    public function getAll()
    {
        $repository = new ConfigRepository();
        $responseDto = $this->buildResponse($repository->getAllData());

        return $responseDto;
    }

    public function updateBatch($input)
    {
        $repository = new ConfigRepository();

        foreach ($input as $key => $element) {
            $dto = array("value" => $element);
            $responseDto = $this->buildResponse($repository->update($key, $dto));

            if (!$responseDto->ok()) {
                return $responseDto;
            }
        }

        $responseDto = new ResponseDto();
        $responseDto->status_code = 200;

        return $responseDto;
    }
}
