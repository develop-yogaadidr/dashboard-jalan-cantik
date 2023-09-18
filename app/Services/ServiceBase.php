<?php

namespace App\Services;

use App\Models\Dtos\ResponseDto;

class ServiceBase
{
    protected function buildResponse($response)
    {
        $responseDto = new ResponseDto();
        $responseBody = $response->object();

        $responseDto->status_code = $response->status();
        $responseDto->message = $responseBody->message ?? "";

        if ($response->ok()) {
            $responseDto->body = $responseBody;
        }

        return $responseDto;
    }
}
