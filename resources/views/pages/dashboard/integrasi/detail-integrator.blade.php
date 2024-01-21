@extends('layouts.dashboard')

@section('content')
    <x-card>
        <x-form method="post" action="update" need-validation enctype="multipart/form-data">
            <div class="row">
                <x-forms.input name="id" type="hidden" value="{{ $data->body->id }}" />
                <x-forms.input name="name" type="text" label="Nama" value="{{ $data->body->name }}" />
                <x-forms.input name="callback_url" type="text" label="Callback URL" value="{{ $data->body->callback_url }}" />
                <x-forms.input name="user" type="text" label="User terhubung" readonly
                    value="{{ $data->body->user->name }}" />
                <x-forms.textarea name="description" label="Deskripsi">
                    {{ $data->body->description }}
                </x-forms.textarea>
                <div class="form-group">
                    <button class="btn btn-primary mb-4" id="save" type="submit">Simpan</button>
                </div>
            </div>
        </x-form>
    </x-card>
@endsection
