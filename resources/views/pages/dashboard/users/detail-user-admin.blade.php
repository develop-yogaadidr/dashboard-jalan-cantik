@extends('layouts.dashboard')
@php
    $user = $data->body;
    $user_roles = ['Admin', 'Admin Provinsi', 'Admin Balai Nasional', 'Admin Balai Provinsi', 'Admin Kab/Kota', 'Pimpinan'];
@endphp
@section('content')
    <x-card>
        <x-form method="post" action="simpan" need-validation>
            <input name="id" type="hidden" value="{{ $user->id }}" />
            <x-forms.input name="name" type="text" label="Nama" value="{{ $user->name }}" />
            <x-forms.input name="email" type="email" label="Email" value="{{ $user->email }}" />
            <x-forms.select name="role" label="Role" id="role">
                @foreach ($user_roles as $role)
                    <option @if ($user->role == $role) selected @endif value="{{ $role }}">{{ $role }}
                    </option>
                @endforeach
            </x-forms.select>
            <div id="admin_role_container">
                <x-forms.select id="admin_role" name="admin_role_id" label="Level Admin">
                    @foreach ($roles as $role)
                        <option @if ($user->admin_role_id == $role->id) selected @endif value="{{$role->id}}">{{ $role->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>
            <x-button color="primary" type="submit" width="100">Simpan</x-button>
        </x-form>
    </x-card>

    <script>
        $(document).ready(function() {
            updateLevelAdminSelect($("#role").val());

            $("#role").on('change', function() {
                updateLevelAdminSelect(this.value)
            });

            function updateLevelAdminSelect(selectedRole) {
                if (selectedRole != 'Admin Balai Provinsi' && selectedRole != 'Admin Kab/Kota') {
                    $('#admin_role').prop('disabled', true);
                    $('#admin_role_container').css('display', 'none');
                    return;
                }
                $('#admin_role').prop('disabled', false);
                $('#admin_role_container').css('display', 'block');
            }
        })
    </script>
@endsection
