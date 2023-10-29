<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.public.home', ["title" => "Home"]);
    }
}
