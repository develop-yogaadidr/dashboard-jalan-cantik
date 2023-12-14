<?php

namespace App\Repositories;

use App\Models\Dtos\RoadsRequestDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoadRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/roads", "");
    }

    public function createData(Request $request, $dto)
    {
        $builder = Http::withToken($this->token);

        if ($request->hasFile("geojson_file")) {
            $builder->attach('geojson_file', file_get_contents($request->file('geojson_file')->path()), $request->file('geojson_file')->getClientOriginalName());
        }

        $response = $builder->post($this->base_url, $dto);

        return $response;
    }

    public function updateData(Request $request, $id, $dto)
    {
        $builder = Http::withToken($this->token);

        if ($request->hasFile("geojson_file")) {
            $builder->attach('geojson_file', file_get_contents($request->file('geojson_file')->path()), $request->file('geojson_file')->getClientOriginalName());
        }

        $response = $builder->post($this->base_url . '/' . $id, $dto);

        return $response;
    }
}
