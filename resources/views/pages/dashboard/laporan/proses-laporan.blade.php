@extends('layouts.dashboard')

@php

    $images = [];
    if ($data->status_code == 200) {
        if ($status == 'Proses Pengerjaan' || $status == 'Selesai') {
            $images = ['image1', 'image2', 'image3', 'image4', 'image5', 'image6'];
        }
    }

@endphp

@section('content')
    <x-card>
        <x-form method="post" action="{{ $status }}/create" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="info" rows="3"></textarea>
            </div>
            @foreach ($images as $image)
                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar 1</label>
                    <input class="form-control" type="file" name="{{ $image }}" id="{{ $image }}">
                </div>
            @endforeach
            <x-button color="primary" type="submit" width="100">Simpan</x-button>
            <button class="btn btn-outline-secondary" onclick="history.back()" type="button"
                data-dismiss="modal">Batal</button>
        </x-form>
    </x-card>
@endsection
