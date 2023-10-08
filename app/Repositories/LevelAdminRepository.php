<?php

namespace App\Repositories;

use App\Models\Dtos\UpdateLevelAdminDetailDto;
use Illuminate\Support\Facades\Http;

class LevelAdminRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/admin-roles", "");
    }

    public function getAllCities($id)
    {
        $response = Http::withToken($this->token)->get($this->base_url . "/" . $id . "/cities");

        return $response;
    }

    public function updateDetail($id, UpdateLevelAdminDetailDto $dto)
    {
        $response = Http::withToken($this->token)->put($this->base_url . '/' . $id . '/detail', $dto);

        return $response;
    }
}
