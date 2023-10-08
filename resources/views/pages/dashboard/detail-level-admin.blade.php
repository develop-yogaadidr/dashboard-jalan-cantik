@extends('layouts.dashboard')
@php
    $level = $data->body;
    $cities = $cities->body;
@endphp
@section('content')
    <x-card>
        <x-form method="post" action="simpan" need-validation>
            <input name="id" type="hidden" value="{{ $level->id }}" />
            <x-forms.input name="name" type="text" label="Nama" value="{{ $level->name }}" />
            <p class="mb-2 mt-4">Daftar Kota</p>
            <div class="row mb-4">
                @foreach ($cities as $city)
                    <div class="col-md-2 col-sm-3 col-xs-4">
                        <input type="checkbox" name="city_ids[]" class="btn-check" id="btn-check-outlined{{ $loop->index }}"
                            autocomplete="off" value="{{ $city->id }}" @if ($city->selected == 1) checked @endif>
                        <label class="btn btn-outline-success"
                            for="btn-check-outlined{{ $loop->index }}">{{ $city->name }}</label><br>
                    </div>
                @endforeach
            </div>
            <x-button color="primary" type="submit" width="100">Simpan</x-button>
        </x-form>
    </x-card>
@endsection
