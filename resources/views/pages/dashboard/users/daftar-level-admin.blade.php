@extends('layouts.dashboard')

@section('content')
    <x-data-table id="myTable" nofilter>
        <x-slot name="table_content">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah Kota</th>
                <th>Detail</th>
            </thead>
            <tbody></tbody>
        </x-slot>
    </x-data-table>

    <script>
        $(document).ready(function() {
            let url = ("{{ $url }}").replace(/&amp;/g, "&")
            $(`#myTable`).Tables({
                url: url,
                columns: ["increment", "name", "admin_city_count", "button.detail"],
                buttons: [{
                    button: "detail",
                    label: "Detail",
                    action_url: "{{ URL::to('/') }}/dashboard/detail-level-admin/{id}"
                }]
            });
        })
    </script>
@endsection
