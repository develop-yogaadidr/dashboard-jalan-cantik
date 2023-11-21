@extends('layouts.app-with-header')

@php

$link = [
    'Diterima' => URL::to('/') . '/laporan-diterima-ai/detail',
    'Proses Pengerjaan' => URL::to('/') . '/laporan-masuk?selected_status=Proses Pengerjaan',
    'Ditolak' => URL::to('/') . '/laporan-masuk?selected_status=Ditolak',
    'Ditunda' => URL::to('/') . '/laporan-masuk?selected_status=Ditunda',
    'Selesai' => URL::to('/') . '/laporan-masuk?selected_status=Selesai',
];

@endphp

@section('content')
    <div class="container">
        <x-card class="p-3 text-center">
            <div class="d-inline-flex mb-3">
                <div class="text-center h3 lh-base mb-4">Laporan Publik</div>
            </div>
            <div class="row gy-4">
            @foreach ($data->body->details as $element)
                <div class="col-4">
                    <a href="{{$link[$element->label]}}" class="card card-counter text-decoration-none shadow link-dark">
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
@endsection
