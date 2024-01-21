@extends('layouts.dashboard')

@section('content')
    <x-data-table id="myTable" nofilter>
        <x-slot name="table_content">
            <thead>
                <th>No</th>
                <th>Nama Integrator</th>
                <th>Deskripsi</th>
                <th>User terhubung</th>
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
                columns: ["increment", "clients.name", "description","users.name", "button.detail"],
                buttons: [{
                    button: "detail",
                    label: "Detail",
                    action_url: "{{ URL::to('/') }}/dashboard/kelola-integrasi/{id}"
                }]
            });
        })
    </script>
@endsection
