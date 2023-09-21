<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class BaseRepository implements IBaseRepository
{
    protected $base_url;
    protected $token = '';

    public function __construct($path)
    {
        $auth = session('auth');
        if ($auth != null) {
            $token = $auth->access_token;
            $this->token = $token;
        }
        $this->base_url = env('SERVER_URL', 'http://localhost/api') . $path;
    }

    public function getAllData($queryString = "")
    {
        $response = Http::withToken($this->token)->get($this->base_url."?".$queryString);

        return $response;
    }

    public function getDataById($id)
    {
        $response = Http::withToken($this->token)->get($this->base_url . '/' . $id);

        return $response;
    }

    public function create($entity)
    {
        $response = Http::withToken($this->token)->post($this->base_url);

        return $response;
    }

    public function update($id, $entity)
    {
        $response = Http::withToken($this->token)->put($this->base_url . '/' . $id, $entity);

        return $response;
    }

    public function delete($id)
    {
        $response = Http::withToken($this->token)->delete($this->base_url . '/' . $id);

        return $response;
    }
}
