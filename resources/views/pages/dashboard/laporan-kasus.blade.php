@extends('layouts.dashboard')

@section('content')
    <div class="row">
        @foreach ($data->data->details as $item)
            <div class="col-md-4">
                <x-counter-card title="{{ $item->label }}" count="{{ $item->counter }}" target="lihat-detail"
                    image="{{$item->icon}}"></x-counter-card>
            </div>
        @endforeach
    </div>
@endsection
