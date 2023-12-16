@extends('layouts.dashboard')

@section('content')
    <x-card>
        <x-form method="post" action="update" need-validation enctype="multipart/form-data">
            <div class="row">
                <x-forms.input name="id" type="hidden" value="{{ $data->body->id }}" />
                <x-forms.input name="name" type="text" label="Nama" value="{{ $data->body->name }}" />
                <x-forms.select name="type" id="type" label="Jenis">
                    @foreach ($types as $type)
                        <option {{ $data->body->type == $type['value'] ? 'selected' : '' }} value="{{ $type['value'] }}">
                            {{ $type['title'] }}</option>
                    @endforeach
                </x-forms.select>
                <div id="city-id-container" style="display:none">
                    <x-forms.select name="city_id" id="city_id" label="Kota/Kabupaten">
                        @foreach ($cities as $city)
                            <option {{ $data->body->city_id == $city->id ? 'selected' : '' }} value="{{ $city->id }}">
                                {{ $city->name }}</option>
                        @endforeach
                    </x-forms.select>
                </div>
                <div class="form-group">
                    <a href="{{ env('GEOJSON_SERVER', '') . $data->body->geojson_url }}" target="_blank"
                        class="btn btn-outline-warning mb-4" type="button">Unduh File Geojson</a>
                    <button class="btn btn-outline-primary mb-4" id="ubah-file" type="button">Perbarui File</button>
                    <input class="form-control" type="file" style="display:none" name="geojson_file" id="geojson_file"
                        accept="file">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mb-4" id="save" type="submit">Simpan</button>
                </div>
            </div>
        </x-form>
    </x-card>

    <script>
        $(document).ready(() => {
            let isEdit = false;
            updateType($("#type").val())

            function updateType(type) {
                if (type == "city") {
                    $("#city-id-container").show();
                } else {
                    $("#city-id-container").hide();
                }
            }

            $("#type").change(function() {
                updateType(this.value)
            })

            $("#ubah-file").click(() => {
                $("#geojson_file").toggle();
                isEdit = !isEdit;

                if (isEdit == true) {
                    $("#ubah-file").html(`Batal Perbarui <i class="fas fa-fw fa-times"/>`)
                    $("#geojson_file").val("");
                } else {
                    $("#ubah-file").html("Perbarui File")
                }
            })
        })
    </script>
@endsection
