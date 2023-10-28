<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProgressReporitory extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("/progress", "");
    }

    public function createProgress(Request $request)
    {
        $builder = Http::withToken($this->token);
        $entity = [
            "report_id" => $request->input("report_id"),
            "status" => $request->input("status"),
            "info" => $request->input("info")
        ];

        if ($request->hasFile("image1"))
            $builder->attach('image1', file_get_contents($request->file('image1')->path()), $request->file('image1')->getClientOriginalName());
        if ($request->hasFile("image2"))
            $builder->attach('image2', file_get_contents($request->file('image2')->path()), $request->file('image2')->getClientOriginalName());
        if ($request->hasFile("image3"))
            $builder->attach('image3', file_get_contents($request->file('image3')->path()), $request->file('image3')->getClientOriginalName());
        if ($request->hasFile("image4"))
            $builder->attach('image4', file_get_contents($request->file('image4')->path()), $request->file('image4')->getClientOriginalName());
        if ($request->hasFile("image5"))
            $builder->attach('image5', file_get_contents($request->file('image5')->path()), $request->file('image5')->getClientOriginalName());
        if ($request->hasFile("image6"))
            $builder->attach('image6', file_get_contents($request->file('image6')->path()), $request->file('image6')->getClientOriginalName());

        $response = $builder->post($this->base_url, $entity);

        return $response;
    }
}
