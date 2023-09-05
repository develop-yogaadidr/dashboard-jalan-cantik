@extends('layouts.dashboard')

@section('content')
    <div class="row">
        @foreach ($data->data->details as $item)
            <div class="col">
                <x-counter-card title="Jalan {{ $item->label }}" count="{{ $item->counter }}" target="lihat-detail"
                    icon="fa fa-road fa-2x"></x-counter-card>
            </div>
        @endforeach
    </div>
@endsection
