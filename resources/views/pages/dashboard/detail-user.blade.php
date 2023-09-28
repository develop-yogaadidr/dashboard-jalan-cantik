@extends('layouts.dashboard')
@php
    $user = $data->body;
    var_dump($user);
    
@endphp
@section('content')
    <x-card>
        <x-form method="post" action="update-ai" need-validation>
            <x-forms.input name="name" type="text" label="Nama" value="{{ $user->name }}" />
            <x-forms.input name="email" type="email" label="Email" value="{{ $user->email }}" />
            <select name="role">
                <option>Admin</option>
                <option>Admin Kota/Kabupaten</option>
                <option>Admin Provinsi</option>
                <option>Admin Provinsi</option>
            </select>
            <x-button color="primary" type="submit" width="100">Simpan</x-button>
        </x-form>
    </x-card>
@endsection
