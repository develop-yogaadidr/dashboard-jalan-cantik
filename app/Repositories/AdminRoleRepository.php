<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class AdminRoleRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/admin-roles", "");
    }
}
