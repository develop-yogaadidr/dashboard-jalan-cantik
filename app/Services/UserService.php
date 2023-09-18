<?php

namespace App\Services;

use App\Models\Dtos\ResponseDto;
use App\Repositories\UserRepository;

class UserService extends ServiceBase
{
    public function getAll()
    {
        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->getAllData());
        
        return $responseDto;
    }
}
