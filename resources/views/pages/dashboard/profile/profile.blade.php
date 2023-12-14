@extends('layouts.dashboard')

@section('content')
    @php
        $profile = session('profile');
    @endphp
    <x-card>
        <x-form method="post" action="profile/update" need-validation enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3  col-sm-12 text-center">
                    <div>
                        <img src="{{ config('app.image_url') . $profile->photo }}"
                            class="img-thumbnail shadow mr-2 mb-3 d-inline-flex"
                            style="max-width:200px;max-height:200px;width:200px; height:200px;object-fit: cover;"
                            alt="{{ $profile->name }}" />
                    </div>
                    <button class="btn btn-primary mb-4" id="ubah-photo" type="button">Ubah Foto</button>
                    <input class="form-control" style="display: none" type="file" name="photo" id="photo"
                        accept="image/*">
                </div>
                <div class="col-md-9 col-sm-12">
                    <x-forms.input name="id" type="hidden" value="{{ $profile->id }}" />
                    <x-forms.input name="name" type="text" label="Nama" value="{{ $profile->name }}" />
                    <x-forms.input name="email" type="email" label="Email" value="{{ $profile->email }}" />
                    <x-forms.input name="phone" type="phone" label="Telepon" value="{{ $profile->phone }}" />
                    <x-forms.input name="twitter" type="text" label="Twitter" value="{{ $profile->twitter }}" />
                    <x-forms.input name="address" type="text" label="Alamat" value="{{ $profile->address }}" />
                    <button class="btn btn-primary mb-4" id="save" type="submit">Simpan</button>
                </div>
            </div>
        </x-form>
    </x-card>

    <script>
        $(document).ready(() => {
            let isEditPhoto = false;
            $("#ubah-photo").click(() => {
                $("#photo").toggle();
                isEditPhoto = !isEditPhoto;

                if (isEditPhoto == true) {
                    $("#ubah-photo").html(`Batal Ubah <i class="fas fa-fw fa-times"/>`)
                    $("#photo").val("");
                } else {
                    $("#ubah-photo").html("Ubah Foto")
                }
            })
        })
    </script>
@endsection
