@extends('layouts.dashboard')

@php
    $image_url = env('IMAGE_SERVER', '');
    $laporan = [];
    $foto_pelapor = [];
    $foto_selesai = [];
    
    if ($data->status_code == 200) {
        $laporan = build_form($data);
    
        $foto_pelapor = array_filter([$data->body->image1, $data->body->image2, $data->body->image3, $data->body->image4, $data->body->image5, $data->body->image6]);
        $foto_selesai = getProgressImages($data->body->progress, 'Selesai');
    }
    
    function build_form($data)
    {
        $temp_laporan = [];
    
        array_push($temp_laporan, build_column(1, 'Pelapor', $data->body->user->name));
        array_push($temp_laporan, build_column(2, 'Email', $data->body->user->email));
        array_push($temp_laporan, build_column(3, 'No.Telp', $data->body->user->phone));
        array_push($temp_laporan, build_column(4, 'Latitude, Longitude', $data->body->latitude . ', ' . $data->body->longitude));
        array_push($temp_laporan, build_column(5, 'Lokasi', 'Klik untuk melihat lokasi'));
        array_push($temp_laporan, build_column(6, 'Tipe', $data->body->type));
        array_push($temp_laporan, build_column(7, 'Info', $data->body->info));
        array_push($temp_laporan, build_column(8, 'Kabupaten/Kota', $data->body->city->name));
        array_push($temp_laporan, build_column(9, 'Status Laporan', $data->body->status));
        array_push($temp_laporan, build_column(10, 'Status Jalan', $data->body->status_jalan));
    
        $date = strtotime($data->body->created_at);
        array_push($temp_laporan, build_column(11, 'Tanggal Pelaporan', date('Y-m-d h:i:s', $date)));
    
        return $temp_laporan;
    }
    
    function getProgressImages($progress, $status)
    {
        $filtered = array_values(array_filter($progress, fn($value, $key) => $value->status == $status, ARRAY_FILTER_USE_BOTH));
        return sizeof($filtered) == 0 ? [] : array_filter([$filtered[0]->image1, $filtered[0]->image2, $filtered[0]->image3, $filtered[0]->image4, $filtered[0]->image5, $filtered[0]->image6]);
    }
    
    function build_column($index, $label, $value)
    {
        return [
            'no' => $index,
            'label' => $label,
            'value' => $value,
        ];
    }
    
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <x-card title="Form Detail Laporan">
                <table class="table">
                    @foreach ($laporan as $item)
                        <tr>
                            <td width="50"><b>{{ $item['no'] }}.</b></td>
                            <td>{{ $item['label'] }}</td>
                            <td>: {{ $item['value'] ?? '-' }}</td>
                        </tr>
                    @endforeach

                </table>
            </x-card>
        </div>
        <div class="col-6">
            <x-card title="Foto Pelapor" class="col">
                <div class="row">
                    @foreach ($foto_pelapor as $photo)
                        <div class="col">
                            <img src="{{ $image_url . $photo }}" class="w-100 shadow-1-strong rounded mb-4"
                                alt="Boat on Calm Water" />
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
        <div class="col-6">
            <x-card title="Foto Selesai" class="col">
                <div class="row">
                    @foreach ($foto_selesai as $photo)
                        <div class="col">
                             <img src="{{ $image_url . $photo }}" class="w-100 shadow-1-strong rounded mb-4"
                                alt="Boat on Calm Water" />
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </div>
@endsection
