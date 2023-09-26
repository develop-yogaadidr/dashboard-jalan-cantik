@extends('layouts.dashboard')

@section('content')
    <x-card>
        <div class="table-responsive">
            <x-data-table id="myTable">
                <thead>
                    <th>No</th>
                    <th>Pelapor</th>
                    <th>Tipe</th>
                    <th>Informasi</th>
                    <th>Tanggal</th>
                    <th>Status Laporan</th>
                    <th>Status Jalan</th>
                    <th>Kota</th>
                </thead>
                <tbody></tbody>
            </x-data-table>
        </div>
    </x-card>
    <script>
        $(document).ready(function() {
            $(`#myTable`).Tables({
                url: "{{ $url }}",
                entity: "reports",
                columns: ["increment", "user.name", "type", "info", "created_at", "status", "status_jalan",
                    "city.name"
                ],
                buttons: [{
                    button: "detail",
                    action_url: "{{ URL::to('/') }}/dashboard/laporan"
                }]
            });
        })
    </script>
@endsection
