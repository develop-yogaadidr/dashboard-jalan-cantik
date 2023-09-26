<?php

namespace App\Repositories;

class CityRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/cities", "");
    }
}
