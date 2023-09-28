<?php

namespace App\Repositories;

class LevelAdminRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/admin-roles", "");
    }
}
