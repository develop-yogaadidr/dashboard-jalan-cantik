@extends('layouts.dashboard')
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
                @php
                    $ip_whitelist = '';
                    foreach ($data->integrasi->ip_whitelist as $ip) {
                        $ip_whitelist .= $ip_whitelist == '' ? $ip->ip_address : ',' . $ip->ip_address;
                    }
                @endphp
                <x-forms.input name="name" type="text" label="Nama" value="{{ $data->integrasi->name }}" />
                <x-forms.input name="callback_url" type="text" label="Callback URL"
                    value="{{ $data->integrasi->callback_url }}" />
                <x-forms.input name="ip_whitelist" type="text" label="IP Whitelist"
                    value="{{ $ip_whitelist }}" description="Untuk lebih dari 1 alamat ip, pisahkan dengan semikolon (;). Contoh: 192.168.xx.xx;192.168.yy.yy" />
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
