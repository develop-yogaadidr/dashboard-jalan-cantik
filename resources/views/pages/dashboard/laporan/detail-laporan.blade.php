@extends('layouts.dashboard')

@php
    $image_url = env('IMAGE_SERVER', '');
    $laporan_id = 0;
    $laporan = [];
    $action_buttons = [];
    $foto_pelapor = [];

    $data_selesai = null;
    $data_pengerjaan = null;
    $data_ditolak = null;
    $data_ditunda = null;

    if ($data->status_code == 200) {
        $laporan = build_form($data);
        $action_buttons = build_action_button($data->body);
        $laporan_id = $data->body->id;

        $foto_pelapor = get_images($data->body);
        $data_selesai = get_progress_data($data->body->progress, 'Selesai');
        $data_pengerjaan = get_progress_data($data->body->progress, 'Proses Pengerjaan');
    }

    function build_form($data)
    {
        $data_ditunda = get_progress_data($data->body->progress, 'Ditunda');
        $data_ditolak = get_progress_data($data->body->progress, 'Ditolak');

        $temp_laporan = [];

        $status = $data->body->status;
        if ($data->body->status == 'Ditolak') {
            $status .= ' (alasan penolakan: ' . $data_ditolak->info . ')';
        } elseif ($data->body->status == 'Ditunda') {
            $status .= ' (alasan penundaan: ' . $data_ditunda->info . ')';
        }

        array_push($temp_laporan, build_column(1, 'Pelapor', $data->body->user->name));
        array_push($temp_laporan, build_column(2, 'Email', $data->body->user->email));
        array_push($temp_laporan, build_column(3, 'No.Telp', $data->body->user->phone));
        array_push($temp_laporan, build_column(4, 'Latitude, Longitude', $data->body->latitude . ', ' . $data->body->longitude));
        array_push($temp_laporan, build_column(5, 'Lokasi', 'Klik untuk melihat lokasi', 'https://www.google.com/maps/place/' . $data->body->latitude . ',' . $data->body->longitude));
        array_push($temp_laporan, build_column(6, 'Tipe', $data->body->type));
        array_push($temp_laporan, build_column(7, 'Info', $data->body->info));
        array_push($temp_laporan, build_column(8, 'Kabupaten/Kota', $data->body->city->name));
        array_push($temp_laporan, build_column(9, 'Status Laporan', $status));
        array_push($temp_laporan, build_column(10, 'Status Jalan', $data->body->status_jalan));

        $date = strtotime($data->body->created_at);
        array_push($temp_laporan, build_column(11, 'Tanggal Pelaporan', date('Y-m-d h:i:s', $date)));

        return $temp_laporan;
    }

    function get_progress_data($progress, $status)
    {
        $filtered = array_values(array_filter($progress, fn($value, $key) => $value->status == $status, ARRAY_FILTER_USE_BOTH));
        if (sizeof($filtered) == 0) {
            return null;
        }

        $filtered[0]->images = get_images($filtered[0]);

        return $filtered[0];
    }

    function get_images($data)
    {
        return array_filter([$data->image1, $data->image2, $data->image3, $data->image4, $data->image5, $data->image6]);
    }

    function build_column($index, $label, $value, $link = '')
    {
        return [
            'no' => $index,
            'label' => $label,
            'value' => $value,
            'link' => $link,
        ];
    }

    function build_action_button($laporan)
    {
        $ditolak = ['title' => 'Ditolak', 'icon' => 'fas fa-fw fa-times', 'color' => 'btn-primary'];
        $ditunda = ['title' => 'Ditunda', 'icon' => 'fas fa-fw fa-exclamation', 'color' => 'btn-primary'];
        $selesai = ['title' => 'Selesai', 'icon' => 'fas fa-fw fa-check', 'color' => 'btn-primary'];
        $proses = ['title' => 'Proses Pengerjaan', 'icon' => 'fas fa-fw fa-wrench', 'color' => 'btn-primary'];

        $actions = [
            'Diterima' => [$ditolak, $ditunda, $selesai, $proses],
            'Ditunda' => [$selesai, $proses],
            'Proses Pengerjaan' => [$selesai],
            'Ditolak' => [],
            'Selesai' => [],
        ];

        return !array_key_exists($laporan->status, $actions) ? [] : $actions[$laporan->status];
    }

@endphp

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            @foreach ($action_buttons as $action)
                <a href="{{ URL::to('/') }}/dashboard/laporan/{{ $laporan_id }}/{{ $action['title'] }}"
                    class="btn {{ $action['color'] }}"> <i class="{{ $action['icon'] }}"></i>
                    {{ $action['title'] }}</a>
            @endforeach
        </div>
        <div class="col-8">
            <x-card title="Form Detail Laporan">
                <table class="table">
                    @foreach ($laporan as $item)
                        <tr>
                            <td width="80"><b>{{ $item['no'] }}.</b></td>
                            <td width="200">{{ $item['label'] }}</td>
                            <td>:
                                @if ($item['link'] != '')
                                    <a href="{{ $item['link'] }}" target="_blank">{{ $item['value'] ?? '-' }}</a>
                                @else
                                    {{ $item['value'] ?? '-' }}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </table>
            </x-card>
        </div>
        <div class="col-4">
            <x-card title="Foto Pelapor" class="col">
                <div class="row">
                    @foreach ($foto_pelapor as $photo)
                        <div class="col-4">
                            <img src="{{ $image_url . $photo }}" class="w-100 shadow-1-strong rounded mb-4"
                                alt="image laporan" />
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
        @if ($data_pengerjaan != null && sizeof($data_pengerjaan->images) > 0)
            <div class="col-4">
                <x-card title="Proses Pengerjaan" class="col">
                    <div class="row">
                        <p>
                            <span>Keterangan: {{ $data_pengerjaan->info ?? '-' }}</span>
                        </p>
                        @foreach ($data_pengerjaan->images as $photo)
                            <div class="col-4">
                                <img src="{{ $image_url . $photo }}" class="w-100 shadow-1-strong rounded mb-4"
                                    alt="image laporan" />
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        @endif
        @if ($data_selesai != null && sizeof($data_selesai->images) > 0)
            <div class="col-4">
                <x-card title="Selesai" class="col">
                    <div class="row">
                        @if ($data_selesai == null || ($data_selesai != null && sizeof($data_selesai->images) == 0))
                            <div class="alert alert-light" role="alert">
                                Foto belum diunggah
                            </div>
                        @else
                            <p>
                                <span>Keterangan: {{ $data_selesai->info ?? '-' }}</span>
                            </p>
                            @foreach ($data_selesai->images as $photo)
                                <div class="col-4">
                                    <img src="{{ $image_url . $photo }}" class="w-100 shadow-1-strong rounded mb-4"
                                        alt="image laporan" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                </x-card>
            </div>
        @endif
    </div>
@endsection
