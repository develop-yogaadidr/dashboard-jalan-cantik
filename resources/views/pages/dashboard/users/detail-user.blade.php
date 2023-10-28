@extends('layouts.dashboard')
@php
    $user = $data->body;
@endphp
@section('content')
    <x-card>
        <x-form method="post" action="update-ai" need-validation>
            <x-forms.input name="name" type="text" label="Nama" value="{{ $user->name }}" />
            <x-forms.input name="email" type="email" label="Email" value="{{ $user->email }}" />
        </x-form>
    </x-card>
@endsection
