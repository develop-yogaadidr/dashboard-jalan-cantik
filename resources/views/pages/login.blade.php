@extends('layouts.app')
@section('content')
    <x-container align="center" size="fluid">
        <x-card title="Login" style="margin-top: calc(25% - 100px)">
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <x-form method="post" action="login" need-validation class="row g-3">
                <x-forms.input name="email" type="text" label="Email" required value="dpupurbalingga@gmail.com" />
                <x-forms.input name="password" type="password" label="Password" required value="purbalingga123" />
                <x-button color="primary" type="submit">Login</x-button>
            </x-form>
        </x-card>
    </x-container>
@endsection
