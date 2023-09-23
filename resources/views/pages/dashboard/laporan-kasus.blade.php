@extends('layouts.dashboard')

@section('content')
    <div class="row">
        @foreach ($data->body->details as $item)
            <div class="col-md-4">
                <x-counter-card title="{{ $item->label }}" count="{{ $item->counter }}"
                    target="{{ URL::to('/') . '/dashboard/laporan/kasus-jalan/'.$item->label }}" image="{{ $item->icon }}"></x-counter-card>
            </div>
        @endforeach
    </div>
@endsection
