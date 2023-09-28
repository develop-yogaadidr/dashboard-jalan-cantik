@extends('layouts.dashboard')

@section('content')
<x-card>
    <div class="table-responsive">
        <x-data-table id="myTable">
            <thead>
                <th>Nama</th>
                <th>Jumlah Kota</th>
            </thead>
            <tbody></tbody>
        </x-data-table>
    </div>
</x-card>

<script>
    $(document).ready(function() {
        $(`#myTable`).Tables({
            url: "{{$url}}",
            columns: ["name", "admin_city_count"],
            buttons: [{
                button: "detail",
                action_url: "{{ URL::to('/') }}/dashboard/detail-level-admin"
            }]
        });
    })
</script>

@endsection