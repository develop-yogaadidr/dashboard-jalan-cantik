@extends('layouts.app')

@section('content')
    <style>
        .image-tentang {
            width: 350px;
            height: 350px;
            object-fit: cover;
            border-radius: 16px;
        }

        .image-tentang-small {
            width: 250px;
            height: 250px;
        }
    </style>
    <div class="container pt-5 pb-5">
        <div class="title text-center mb-5">
            <h2>{{ $title }}</h2>
        </div>
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="row gy-4">
                    <div class="col-md-6 col-sm-12"><img class="img image-tentang shadow mr-2 d-inline-flex"
                            src="{{ URL::to('/') . '/public/images/trotoar.jpg' }}">
                    </div>
                    <div class="col-md-6 col-sm-12 text-left align-self-end"><img
                            class="img image-tentang image-tentang-small shadow mr-2 d-inline-flex"
                            src="{{ URL::to('/') . '/public/images/launching.jpg' }}">
                    </div>
                    <div class="col-md-6 col-sm-12 text-right"><img
                            class="img image-tentang image-tentang-small shadow mr-2 d-inline-flex"
                            src="{{ URL::to('/') . '/public/images/petugas-dpu.jpg' }}"></div>
                    <div class="col-md-6 col-sm-12"><img class="img image-tentang shadow mr-2 d-inline-flex"
                            src="{{ URL::to('/') . '/public/images/jalan.jpeg' }}">
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <x-card class="p-3" title="Jalan Cantik">
                    Jalan cantik adalah aplikasi yang berfungsi untuk melaporkan kerusakan jalan dan jembatan yang berada di
                    wilayah provinsi jawa tengah. Aplikasi Jalan Cantik di bangun oleh DPU Bina Marga Cipta Karya Provinsi
                    Jawa Tengah ( DPU BINMARCIPKA JATENG ) sebagai bentuk pelayanan kepada masyarakat jawa tengah melalui
                    aplikasi tersebut. Anda bisa melaporkan situasi kerusakan jalan atau jembatan yang anda lihat melalui
                    aplikasi yang tersedia di play store. Laporan yang anda laporkan bisa di pantau melalui aplikasi dari
                    proses pengerjaan jalan hingga selesai akan kami laporkan kepada anda melalui aplikasi Jalan Cantik
                </x-card>
            </div>
        </div>

    </div>
@endsection
