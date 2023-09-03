<?php

namespace App\Models\Dtos;

class ResponseDto
{
    public $data;
    public $message;
    public $status_code;

    public function ok(){
        return $this->status_code == 200;
    }
}
