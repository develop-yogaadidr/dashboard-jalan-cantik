<?php

namespace App\Models\Dtos;

class ResponseDto
{
    public $body;
    public $message;
    public $status_code;

    public function ok(){
        return $this->status_code >= 200 && $this->status_code <= 299;
    }
}
