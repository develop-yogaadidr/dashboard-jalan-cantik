@extends('layouts.app')
@section('content')
    <x-container align="center" size="fluid">
        <x-card title="Login" style="margin-top: calc(25% - 100px)">
            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif
            <x-form method="post" action="login" need-validation>
                <x-forms.input name="username" type="text" label="Username" required value="lhnmitra29" />
                <x-forms.input name="password" type="password" label="Password" required value="rahasia" />
                <x-button color="primary" type="submit">Login</x-button>
            </x-form>
        </x-card>
    </x-container>
@endsection
