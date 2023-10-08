<?php

namespace App\Services;

use App\Models\Dtos\UpdateAdminRequestDto;
use App\Repositories\LevelAdminRepository;
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

    public function getAllLevelAdmin($queryString = "")
    {
        $repository = new LevelAdminRepository();
        $responseDto = $this->buildResponse($repository->getAllData($queryString));

        return $responseDto;
    }

    public function getLevelAdminById($id)
    {
        $repository = new LevelAdminRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id));

        return $responseDto;
    }

    public function update($input)
    {
        $dto = new UpdateAdminRequestDto();
        $id = $input['id'];
        $dto->name = $input['name'];
        $dto->email = $input['email'];
        $dto->role = $input['role'];
        $dto->admin_role_id = $input['admin_role_id'];
        
        var_dump($dto);

        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->update($id, $dto));

        return $responseDto;
    }
}
