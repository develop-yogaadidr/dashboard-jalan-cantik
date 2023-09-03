<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.dashboard.index', ["title" => "Home"]);
    }

    public function table(Request $request)
    {
        return view('pages.dashboard.table', ["title" => "Table"]);
    }
}
