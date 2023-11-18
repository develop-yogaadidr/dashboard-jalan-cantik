<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.public.home', ["title" => "Beranda", "active_menu" => "beranda"]);
    }

    public function tentang(Request $request)
    {
        return view('pages.public.tentang', ["title" => "Tentang Jalan Cantik", "active_menu" => "tentang"]);
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
        return view('pages.public.download', ["title" => "Download", "active_menu" => "download"]);
    }

    public function kontak(Request $request)
    {
        return view('pages.public.kontak', ["title" => "Kontak", "active_menu" => "kontak"]);
    }
    
    public function privacyPolicy(Request $request)
    {
        return view('pages.public.privacy-policy', ["title" => "Privacy - Policy", "active_menu" => "privacy-policy"]);
    }
}
