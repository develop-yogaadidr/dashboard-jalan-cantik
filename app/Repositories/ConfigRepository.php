<?php

namespace App\Repositories;

class ConfigRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/configs", "");
    }
}
