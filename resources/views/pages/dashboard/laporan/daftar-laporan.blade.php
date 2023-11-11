@extends('layouts.dashboard')
@php
    $statuses = [['label' => 'Semua Status Laporan', 'value' => 'all'], ['label' => 'Diterima', 'value' => 'Diterima'], ['label' => 'Proses Pengerjaan', 'value' => 'Proses Pengerjaan'], ['label' => 'Ditolak', 'value' => 'Ditolak'], ['label' => 'Ditunda', 'value' => 'Ditunda'], ['label' => 'Selesai', 'value' => 'Selesai']];
    $current_year = Date('Y');
    $years = [['label' => 'Semua Tahun Laporan', 'value' => 'all']];
    for ($i = 0; $i < 4; $i++) {
        array_push($years, ['label' => $current_year - $i, 'value' => $current_year - $i]);
    }
    
@endphp
@section('content')
    <x-card>
        <h5>Filter</h5>
        <x-form method="get" action="" class="form-inline mb-4">
            <select class="form-control mb-2 mr-sm-2" name="selected_year">
                @foreach ($years as $year)
                    <option {{ $year['value'] == $filter['selected_year'] ? 'selected' : '' }} value="{{ $year['value'] }}">
                        {{ $year['label'] }}</option>
                @endforeach
            </select>
            <select class="form-control mb-2 mr-sm-2" name="selected_status">
                @foreach ($statuses as $status)
                    <option {{ $status['value'] == $filter['selected_status'] ? 'selected' : '' }}
                        value="{{ $status['value'] }}">
                        {{ $status['label'] }}</option>
                @endforeach
            </select>
            <select class="form-control mb-2 mr-sm-2" name="selected_city">
                <option value="all">Semua Kota/Kabupaten</option>
                @foreach ($cities as $city)
                    <option {{ $city->id == $filter['selected_city'] ? 'selected' : '' }} value="{{ $city->id }}">
                        {{ $city->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-fw fa-filter"></i> Filter</button>
        </x-form>

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
            let url = ("{{ $url }}").replace(/&amp;/g, "&")
            $(`#myTable`).Tables({
                url: url,
                entity: "reports",
                columns: ["increment", "users.name", "type", "info", "reports.created_at", "status", "status_jalan","cities.name"
                ],
                buttons: [{
                    button: "detail",
                    action_url: "{{ URL::to('/') }}/dashboard/laporan"
                }]
            });
        })
    </script>
@endsection
