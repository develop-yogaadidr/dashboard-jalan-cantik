@extends('layouts.dashboard')

@section('content')
    <x-card>
        <div class="table-responsive">
            <x-data-table id="myTable">
                <thead>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                </thead>
                <tbody></tbody>
            </x-data-table>
        </div>
    </x-card>

    <script>
        $(document).ready(function() {
            $(`#myTable`).Tables({
                url: "{{ $url }}",
                columns: ["increment", "name", "email", "role"],
                buttons: [{
                    button: "detail",
                    action_url: "{{ URL::to('/') }}/dashboard/detail-user"
                }]
            });
        })
    </script>
@endsection
