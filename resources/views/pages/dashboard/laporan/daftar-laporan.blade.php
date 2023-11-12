@extends('layouts.dashboard')
@php
    $image_url = env('IMAGE_SERVER', '');
@endphp
@section('navbar-content')
    <x-form action="{{ URL::to('/') }}/dashboard/laporan">
        <input type="hidden" name="selected_year" value="{{ $filter['selected_year'] }}">
        <input type="hidden" name="selected_kasus" value="{{ $filter['selected_kasus'] }}">
        <input type="hidden" name="selected_city" value="{{ $filter['selected_city'] }}">
        <input type="hidden" name="selected_status_jalan" value="{{ $filter['selected_status_jalan'] }}">
        @foreach ($counter_status->body->details as $counter)
            <button name="selected_status" value="{{ $counter->label }}"
                class="btn {{ $filter['selected_status'] == $counter->label ? 'btn-info' : 'btn-outline-info' }} btn-sm">{{ $counter->label }}
                ({{ $counter->counter }})
            </button>
        @endforeach
    </x-form>
@endsection
@section('content')
    @include('pages.dashboard.laporan.fragments.list-of-laporan')
@endsection
