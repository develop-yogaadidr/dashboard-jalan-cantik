@extends('layouts.dashboard')

@section('content')
    <div class="row mb-4">
        @foreach ($data['status_laporan']->body->details as $item)
            <div class="col">
                <x-counter-card title="Laporan {{ $item->label }}" count="{{ $item->counter }}"
                    target="lihat-detail"></x-counter-card>
            </div>
        @endforeach
    </div>

    <h1 class="h3 mb-4 text-gray-800">Status Jalan</h1>
    <div class="row">
        @foreach ($data['status_jalan']->body->details as $item)
            <div class="col">
                <x-counter-card title="Jalan {{ $item->label }}" count="{{ $item->counter }}" target="lihat-detail"
                    icon="fa fa-road fa-2x"></x-counter-card>
            </div>
        @endforeach
    </div>
@endsection
