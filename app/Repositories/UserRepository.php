<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/users", "");
    }

    public function getByRole($role, $queryString = "")
    {
        $response = Http::withToken($this->token)->get($this->base_url . "/" . $role . "?" . $queryString);
        
        return $response;
    }

    public function updatePhoto(Request $request)
    {
        $builder = Http::withToken($this->token);

        if ($request->hasFile("photo"))
            $builder->attach('photo', file_get_contents($request->file('photo')->path()), $request->file('photo')->getClientOriginalName());
    
        $response = $builder->post($this->base_url . '/photo');
        
        return $response;
    }

    public function updateMyIntegrationData($dto)
    {
        $response = Http::withToken($this->token)->put($this->base_url . '/me/integration/update', $dto);
        
        return $response;
    }

    public function regenerateMyApiKey()
    {
        $response = Http::withToken($this->token)->post($this->base_url . '/me/integration/regenerate-api-key');
        
        return $response;
    }
}
