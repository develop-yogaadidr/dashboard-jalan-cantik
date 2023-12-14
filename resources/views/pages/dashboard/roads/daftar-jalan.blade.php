@extends('layouts.dashboard')

@section('content')
    <x-data-table id="myTable" nofilter>
        <x-slot name="table_content">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Kota/Kabupaten</th>
                <th>Detail</th>
                <th>Download</th>
            </thead>
            <tbody></tbody>
        </x-slot>
    </x-data-table>

    <script>
        $(document).ready(function() {
            let url = ("{{ $url }}").replace(/&amp;/g, "&")
            let download_url = "{{env('IMAGE_SERVER', '')}}";
            $(`#myTable`).Tables({
                url: url,
                columns: ["increment", "roads.name", "cities.name", "button.detail", "button.download"],
                buttons: [{
                    button: "detail",
                    label: "Detail",
                    action_url: "{{ URL::to('/') }}/dashboard/kelola-peta/{id}"
                }, {
                    button: "download",
                    label: "Download",
                    target: "_blank",
                    action_url: download_url + "/{geojson_url}"
                }]
            });
        })
    </script>
@endsection
