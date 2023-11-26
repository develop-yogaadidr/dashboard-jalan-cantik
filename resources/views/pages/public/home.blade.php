@extends('layouts.app')

@php

    $link_laporan_kerusakan = [
        'Laporan Masuk' => URL::to('/') . '/laporan-masuk',
        'Laporan Diterima AI' => URL::to('/') . '/laporan-diterima-ai',
        'Laporan Ditolak AI' => URL::to('/') . '/laporan-ditolak-ai',
    ];

    $link_laporan_publik = [
        'Diterima' => URL::to('/') . '/laporan-masuk?selected_status=Diterima',
        'Proses Pengerjaan' => URL::to('/') . '/laporan-masuk?selected_status=Proses Pengerjaan',
        'Ditolak' => URL::to('/') . '/laporan-masuk?selected_status=Ditolak',
        'Ditunda' => URL::to('/') . '/laporan-masuk?selected_status=Ditunda',
        'Selesai' => URL::to('/') . '/laporan-masuk?selected_status=Selesai',
    ];

@endphp

@section('content')
    <style>
        .header {
            height: 600px;
            width: 100vw;
            background: black;
            overflow: hidden;
            position: relative;
        }

        .header-image {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        .header-tagline {
            position: absolute;
            top: 40%;
            left: 35%;
            transform: translate(-50%, -50%);
            max-width: 800px;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        .header-info {
            position: absolute;
            top: 20%;
            right: 10%;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            align-items: center;
        }

        .header-info-content {
            width: 450px;
            height: 450px;
            position: relative;
            background-image: url("{{ URL::to('/') . '/public/images/liquid.png' }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .header-info-content img {
            width: 150px;
            position: absolute;
            left: -60px;
            top: 100px;
            transform: rotate(-5deg);
        }

        .map {
            height: 400px;
            background: #f0f1f5;
            border-bottom: 1px solid #dadada;
        }
    </style>
    <section class="header">
        <img class="header-image" src="{{ URL::to('/') . '/public/images/beranda.png' }}" alt="Five developers at work.">
        <div class="header-tagline">
            <p class="text-white font-weight-bold h2 mb-4 lh-base">Mari Kita Bangun Bersama Provinsi Jawa Tengah<br />
                Dengan Melaporkan Jalan<br />
                & Jembatan yang Rusak</p>
            <a href="{{ URL::to('/') . '/kontak' }}" class="btn btn-danger btn-xl">Kontak Kami</a>
        </div>
        <div class="header-info">
            <div class="header-info-content">
                <img src="{{ URL::to('/') . '/public/images/mockups/home.png' }}">
                <div style="position: absolute;width: 300px;top: 90px;left: 100px;">
                    <h4 class="font-weight-bold h3">Jalan Cantik</h4>
                    <p class="text-white mb-5 h5 lh-base">Aplikasi yang berfungsi untuk melaporkan kerusakan jalan dan
                        jembatan
                        di
                        wilayah Provinsi Jawa Tengah</p>
                    <a href="" class="btn btn-warning mr-2">Selengkapnya</a>
                    <a href="{{ URL::to('/') . '/download' }}" class="btn btn-danger"><i class="fa fa-download"></i>
                        Download</a>
                </div>
            </div>
        </div>
    </section>
    <section class="map">

    </section>
    <section class="counter p-5">
        <div class="container">
            <x-card class="p-5 text-center">
                <div class="d-inline-flex mb-5">
                    <img src="{{ URL::to('/') . '/public/images/blog.png' }}" style="height:80px" class="mr-3">
                    <div class="text-center h3 lh-base mb-4">Laporan Kerusakan di <br />Provinsi Jawa Tengah</div>
                </div>
                <div class="row justify-content-md-center">
                    @foreach ($counter['total']->body as $element)
                        <div class="col-3">
                            <a href="{{ $link_laporan_kerusakan[$element->label] }}"
                                class="card card-counter text-decoration-none shadow link-dark hover-scale">
                                <div class="card-body text-center">
                                    <h2>{{ $element->counter }}</h2>
                                    <span>{{ $element->label }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </section>

    <section class="counter pb-5">
        <div class="container">
            <x-card class="p-5 text-center">
                <div class="d-inline-flex mb-5">
                    <div class="text-center h3 lh-base mb-4">Laporan Publik</div>
                </div>
                <div class="row gy-4 justify-content-md-center">
                    @foreach ($counter['publik']->body->details as $element)
                        <div class="col-4">
                            <a href="{{ $link_laporan_publik[$element->label] }}"
                                class="card card-counter text-decoration-none shadow link-dark hover-scale">
                                <div class="card-body text-center">
                                    <h2>{{ $element->counter }}</h2>
                                    <span>{{ $element->label }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </section>
@endsection
