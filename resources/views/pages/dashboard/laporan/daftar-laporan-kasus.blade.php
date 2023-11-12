@extends('layouts.dashboard')

@section('content')
    <div class="row">
        @foreach ($data->body->details as $item)
            <div class="col-md-4">
                <x-counter-card title="{{ $item->label }}" count="{{ $item->counter }}"
                    target="{{ URL::to('/') . '/dashboard/laporan?selected_kasus='.$item->label.'&selected_status=Diterima' }}" image="{{ $item->icon }}"></x-counter-card>
            </div>
        @endforeach
    </div>
@endsection
