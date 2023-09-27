<?php

namespace App\Services;

use App\Repositories\AdminRoleRepository;
use App\Repositories\UserRepository;

class UserService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->getAllData($queryString));

        return $responseDto;
    }

    public function getByRole($role, $queryString = "")
    {
        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->getByRole($role, $queryString));

        return $responseDto;
    }

    public function getById($id)
    {
        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id));

        return $responseDto;
    }

    public function getAllAdminRole($queryString = "")
    {
        $repository = new AdminRoleRepository();
        $responseDto = $this->buildResponse($repository->getAllData($queryString));

        return $responseDto;
    }

    public function getAdminRoleById($id)
    {
        $repository = new AdminRoleRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id));

        return $responseDto;
    }
}
