<?php

namespace App\Repositories;

class IntegrationRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/clients", "");
    }
}
