@extends('layouts.dashboard')

@section('content')
<x-card>
    <div class="table-responsive">
        <x-data-table url="{{$url}}" columns="name,email,role">
            <thead>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </thead>
            <tbody></tbody>
        </x-data-table>
    </div>
</x-card>

@endsection