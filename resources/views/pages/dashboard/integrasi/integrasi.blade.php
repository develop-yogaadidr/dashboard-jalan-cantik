@extends('layouts.dashboard')
@php
    var_dump($data);
@endphp
@section('content')
    <x-card title="Informasi API Key">
        <x-form method="post" action="integrasi/regenerate-key" need-validation onkeydown="return event.key != 'Enter';">
            <div class="row">
                <x-forms.input name="api_key" type="text" label="API Key" readonly value="{{ $data->integrasi->api_key }}" />
                <div class="form-group">
                    <button class="btn btn-primary mb-4" id="save" type="submit">Perbarui API Key</button>
                </div>
            </div>
        </x-form>
    </x-card>
    <x-card title="Informasi Integrasi">
        <x-form method="post" action="integrasi/update" need-validation>
            <div class="row">
                <x-forms.input name="name" type="text" label="Nama" value="{{ $data->integrasi->name }}" />
                <x-forms.input name="callback_url" type="text" label="Callback URL"
                    value="{{ $data->integrasi->callback_url }}" />
                <x-forms.textarea name="description" label="Deskripsi">
                    {{ $data->integrasi->description }}
                </x-forms.textarea>
                <div class="form-group">
                    <button class="btn btn-primary mb-4" id="save" type="submit">Simpan</button>
                </div>
            </div>
        </x-form>
    </x-card>
@endsection
