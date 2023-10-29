<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.public.home', ["title" => "Home"]);
    }

    public function tentang(Request $request)
    {
        return view('pages.under-construction', ["title" => "Tentang Jalan Cantik"]);
    }
    public function laporanMasuk(Request $request)
    {
        return view('pages.under-construction', ["title" => "Laporan Masuk"]);
    }

    public function laporanDiterimaAi(Request $request)
    {
        return view('pages.under-construction', ["title" => "Laporan Diterima AI"]);
    }

    public function laporanDitolakAi(Request $request)
    {
        return view('pages.under-construction', ["title" => "Laporan Ditolak AI"]);
    }

    public function download(Request $request)
    {
        return view('pages.under-construction', ["title" => "Download"]);
    }

    public function kontak(Request $request)
    {
        return view('pages.under-construction', ["title" => "Kontak"]);
    }
    
    public function privacyPolicy(Request $request)
    {
        return view('pages.under-construction', ["title" => "Privacy - Policy"]);
    }
}
