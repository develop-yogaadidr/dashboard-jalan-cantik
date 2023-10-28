@extends('layouts.dashboard')

@section('content')
    <x-card>
        <x-form method="post" action="update-ai" need-validation>
            @foreach ($data->body->data as $item)
                <x-forms.input name="{{ $item->config_key }}" type="{{ $item->type == 'string' ? 'text' : 'number' }}"
                    label="{{ $item->display_name }}" value="{{ $item->value }}" description="{{ $item->description }}" />
            @endforeach
            <x-button color="primary" type="submit" width="100">Simpan</x-button>
        </x-form>
    </x-card>
@endsection
