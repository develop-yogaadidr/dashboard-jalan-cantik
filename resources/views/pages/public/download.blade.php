@extends('layouts.app')

@php
$contact = config('app.contacts');
$play_store = $contact['play_store'];
$steps = [
[
'number' => 1,
'description' => 'Buka Google Play Store di HP Android, kemudian ketik "Jalan Cantik"',
'image' => URL::to('/') . '/public/images/mockups/download.png',
],
[
'number' => 2,
'description' => 'Install aplikasi "Jalan Cantik"',
'image' => URL::to('/') . '/public/images/mockups/install.png',
],
[
'number' => 3,
'description' => 'Setelah terinstall, buka aplikasi Jalan Cantik di HP',
'image' => URL::to('/') . '/public/images/mockups/welcome.png',
],
[
'number' => 4,
'description' => 'Kemudian registrasi untuk melaporkan kerusakan jalan dan melihat fitur lainnya',
'image' => URL::to('/') . '/public/images/mockups/login.png',
],
];

@endphp



@section('content')
<style>
    .step {
        color: white;
        position: absolute;
        top: 0;
        left: 50px;
        width: 50px;
        height: 50px;
        font-size: 18px;
        font-weight: bold;
        line-height: 50px;
        background: #f6780a;
        border-radius: 100%;
    }
</style>
<div class="container pt-5">
    <div class="title text-center mb-5">
        <h2>Aplikasi</h2>
        <h2>Jalan Cantik</h2>
    </div>
    <hr />
    <section class="row mt-5 text-center mb-5">
        <h5 class="mb-5">
            Berikut 4 langkah untuk menjalankan aplikasi <strong>Jalan Cantik</strong>
        </h5>
        @foreach ($steps as $step)
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="position-relative">
                <img style="width:200px" src="{{ $step['image'] }}" />
                <span class="step">
                    {{ $step['number'] }}
                </span>
            </div>
            <p>{{ $step['description'] }}</>
        </div>
        @endforeach
    </section>
</div>
<section class="row mt-5 text-center mb-5 py-5" style="background:#f0f1f5">
    <h3>JALAN CANTIK</h3>
    <center>
        <a href="{{ $play_store['link'] }}" target="_blank"><img
                src="{{ URL::to('/') . '/public/images/download-google-play.png' }}" class="mb-4"
                style="width:200px" /></a>
        <p style="font-size:16px;max-width:960px">
            Jalan Cantik adalah Aplikasi yang berfungsi untuk melaporkan kerusakan jalan dan jembatan yang berada di
            wilayah
            Provinsi Jawa Tengah. Aplikasi Jalan Cantik dibangun oleh DPU Bina Marga Cipta Karya Provinsi Jawa
            Tengah
            (DPU BINA MARGA CIPTA KARYA) sebagai bentuk pelayanan kepada masyarakat Jawa Tengah melalui Aplikasi
            tersebut.
        </p>
    </center>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 align-self-center">
                <img src="{{ URL::to('/') . '/public/images/illustration.png' }}" style="max-width: 300px;"/>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 align-self-end text-right">
                <div class="d-inline-flex">
                    <div style="display: block;font-size:16px;align-self:center" class="mr-3">
                        <p class="mb-4">Anda dapat melaporkan situasi kerusakan jalan atau jembatan yang anda lihat melalui aplikasi
                            yang tersedia di Play Store</p>
                        <p>Laporan yang anda laporkan dapat dipantau melalui aplikasi dari proses pengerjaan jalan
                            hingga selesai akan kami laporkan kepada anda melalui aplikasi Jalan Cantik</p>
                    </div>

                    <img style="width:300px" src="{{ URL::to('/') . '/public/images/mockups/home.png' }}">
                </div>

            </div>
        </div>
    </div>
</section>
@endsection