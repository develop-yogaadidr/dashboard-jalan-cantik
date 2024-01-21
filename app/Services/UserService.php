<?php

namespace App\Services;

use App\Models\Dtos\UpdateAdminRequestDto;
use App\Models\Dtos\UpdateLevelAdminDetailDto;
use App\Models\Dtos\UpdateProfileRequestDto;
use App\Repositories\LevelAdminRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService extends ServiceBase
{
    public function getAll($queryString = "")
    {
        $repository = new UserRepository();
        $responseDto = $repository->getAllData($queryString)->object();

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
        $responseDto = $repository->getAllData($queryString)->object();

        return $responseDto;
    }

    public function getLevelAdminById($id)
    {
        $repository = new LevelAdminRepository();
        $responseDto = $this->buildResponse($repository->getDataById($id));

        return $responseDto;
    }

    public function getLevelAdminCities($id)
    {
        $repository = new LevelAdminRepository();
        $responseDto = $this->buildResponse($repository->getAllCities($id));

        return $responseDto;
    }

    public function updateLevelAdminDetail($input)
    {
        $dto = new UpdateLevelAdminDetailDto();
        $id = $input['id'];
        $dto->name = $input['name'];
        $dto->role_type = $input['role_type'];
        $dto->city_ids = $input['city_ids'];

        $repository = new LevelAdminRepository();
        $responseDto = $this->buildResponse($repository->updateDetail($id, $dto));

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

        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->update($id, $dto));

        return $responseDto;
    }

    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $dto = new UpdateProfileRequestDto();
        $id = $input['id'];
        $dto->name = $input['name'];
        $dto->email = $input['email'];
        $dto->phone = $input['phone'];
        $dto->twitter = $input['twitter'];
        $dto->address = $input['address'];

        $repository = new UserRepository();

        if ($request->file('photo') != null) {
            $this->buildResponse($repository->updatePhoto($request));
        }

        $responseUpdateProfile = $this->buildResponse($repository->update($id, $dto));
        if ($responseUpdateProfile->ok()) {
            $this->cacheProfileData($request);
        }

        return $responseUpdateProfile;
    }

    // Integrasi

    public function updateMyIntegrationData(Request $request)
    {
        $dto = [
            "name" => $request->name,
            "description" => $request->description,
            "callback_url" => $request->callback_url,
            "ip_whitelist" => $request->ip_whitelist
        ];

        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->updateMyIntegrationData($dto));

        if ($responseDto->ok()) {
            $this->cacheProfileData($request);
        }

        return $responseDto;
    }

    public function regenerateMyApiKey(Request $request)
    {
        $repository = new UserRepository();
        $responseDto = $this->buildResponse($repository->regenerateMyApiKey());

        if ($responseDto->ok()) {
            $this->cacheProfileData($request);
        }

        return $responseDto;
    }

    private function cacheProfileData(Request $request)
    {
        $auth_service = new AuthService();
        $profile = $auth_service->profile();

        $name = explode(" ", $profile->body->name);
        $profile->body->initial = ($name[0][0] ?? "") . ($name[1][0] ?? "");

        $request->session()->put('profile', $profile->body);
    }
}
