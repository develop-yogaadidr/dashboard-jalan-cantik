@extends('layouts.app')

@section('content')
    @php
        $color = config('app.color');
    @endphp

    <div class="container pt-5 pb-5 mb-5">
        <div class="title text-center mb-5">
            <h2>{{ $title }}</h2>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card rounded shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Keterangan Laporan</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-inline-flex mb-4">
                            <div class="pr-4 mr-4" style="border-right: 1px solid #eaeaea">
                                <span class="title title-big title-primary">No Laporan {{ $data->body->id }}</span><br />
                                <span
                                    class="text-label">{{ formatDateTime($data->body->created_at) }}</span>
                            </div>
                            <div>
                                <span class="chip text-white bg-{{ $color[$data->body->status] }}">
                                    {{ $data->body->status }}
                                </span>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <td valign="top" width="150">Pelapor</td>
                                <td>: {{ $data->body->integrasi == null ? $data->body->user->name : $data->body->integrasi->nama_pelapor }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: {{ $data->body->user->email }}</td>
                            </tr>
                            <tr>
                                <td>No Telp</td>
                                <td>: {{ $data->body->user->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Kasus</td>
                                <td>: {{ $data->body->type }}</td>
                            </tr>
                            <tr>
                                <td>Kabupaten / Kota</td>
                                <td>: {{ $data->body->city->name }}</td>
                            </tr>
                            <tr>
                                <td>Status Jalan</td>
                                <td>: {{ $data->body->status_jalan }}</td>
                            </tr>
                            <tr>
                                <td valign="top">Deskripsi</td>
                                <td>: {{ $data->body->info }}</td>
                            </tr>
                        </table>
                        <iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyClpmIku9wq1BhREuGbxog7qjnT9Wfm02Y&q={{ $data->body->latitude }},{{ $data->body->longitude }}">
                        </iframe>
                    </div>

                </div>
            </div>
            <div class="col-md-5">
                <div class="card rounded shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Tindak Lanjut</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $progress = [
                                [
                                    'status' => 'Diterima',
                                    'date' => formatDateTime($data->body->created_at),
                                    'updater' => $data->body->user->name,
                                    'info' => '',
                                    'color' => $color['Diterima'],
                                    'images' => array_filter([$data->body->image1, $data->body->image2, $data->body->image3, $data->body->image4, $data->body->image5, $data->body->image6]),
                                ],
                            ];

                            foreach ($data->body->progress as $element) {
                                array_push($progress, [
                                    'status' => $element->status,
                                    'date' => formatDateTime($element->created_at),
                                    'updater' => $element->updater->name,
                                    'info' => $element->info,
                                    'color' => $color[$element->status],
                                    'images' => array_filter([$element->image1, $element->image2, $element->image3, $element->image4, $element->image5, $element->image6]),
                                ]);
                            }

                        @endphp
                        @foreach ($progress as $element)
                            <div>
                                <div class="d-inline-flex mb-4">
                                    <div class="mr-4 mt-2 bg-{{ $element['color'] }}"
                                        style="width:12px;height:12px;border-radius:100%"></div>
                                    <div>
                                        <div class="mb-3">
                                            <span
                                                class="title title-big title-primary text-{{ $element['color'] }}">{{ $element['status'] }}</span><br />
                                            <span class="text-label">{{ $element['date'] }}</span><br />
                                        </div>
                                        <div class="mb-4">
                                            <span class="title title-big">{{ $element['updater'] }}</span><br />
                                            <span>{{ $element['info'] }}</span>
                                        </div>
                                        <div>
                                            <x-image-gallery
                                                id="gallery-{{ strtolower(str_replace(' ', '-', $element['status'])) }}">
                                                @foreach ($element['images'] as $image)
                                                    <img src="{{ config('app.image_url') . $image }}"
                                                        class="img-thumbnail shadow mr-2 mb-3 d-inline-flex"
                                                        style="width:100px;height:100px;object-fit: cover;"
                                                        alt="{{ $image }}" />
                                                @endforeach
                                            </x-image-gallery>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
