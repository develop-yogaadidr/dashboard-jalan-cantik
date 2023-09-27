@extends('layouts.dashboard')

@php
    function getUrl($label)
    {
        if ($label == 'Kabupaten/Kota') {
            return '';
        }
    
        return URL::to('/') . '/dashboard/laporan/status-jalan/' . getLabel($label);
    }
    
    function getLabel($label)
    {
        return str_replace('/', '-', $label);
    }
@endphp

@section('content')
    <div class="row mb-4">
        @foreach ($data['status_laporan']->body->details as $item)
            <div class="col">
                <x-counter-card title="Laporan {{ $item->label }}" count="{{ $item->counter }}"
                    target="{{ URL::to('/') . '/dashboard/laporan/status/' . getLabel($item->label) }}"></x-counter-card>
            </div>
        @endforeach
    </div>

    <h1 class="h3 mb-4 text-gray-800">Status Jalan</h1>
    <div class="row">
        @foreach ($data['status_jalan']->body->details as $item)
            <div class="col">
                <x-counter-card title="Jalan {{ $item->label }}" count="{{ $item->counter }}"
                    target="{{ getUrl($item->label) }}" icon="fa fa-road fa-2x">
                    @if (getUrl($item->label) == '')
                        <a class="" data-toggle="collapse" href="#collapseExample{{ getLabel($item->label) }}"
                            role="button" aria-expanded="false"
                            aria-controls="collapseExample{{ getLabel($item->label) }}">
                            Lihat Detail
                        </a>
                        <div class="collapse mt-3" id="collapseExample{{ getLabel($item->label) }}">
                            <x-form method="get"
                                action="{{ URL::to('/') . '/dashboard/laporan/status-jalan/' . getLabel($item->label) }}">
                                <span class="label" for="selected_city">Pilih Kota</span>
                                <select class="form-control mb-2 mr-sm-2" id="selected_city" name="selected_city">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary" type="submit">Lihat Detail</button </x-form>
                        </div>
                    @endif

                </x-counter-card>
            </div>
        @endforeach
    </div>
@endsection
