<!DOCTYPE html>
<html lang="en">

@php
    $color = config('app.color');
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download</title>
    <link href="{{ asset('public/css/font-montserrat.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/jalan-cantik.css') }}" rel="stylesheet" type="text/css">
</head>

<style>
    body {
        font-size: 14px;
        font-family: 'Montserrat';
    }

    .d-inline-flex {
        display: inline-flex;
    }

    .align-item-center {
        align-items: center;
    }

    .mb-4 {
        margin-bottom: 1.75rem;
    }

    .mb-3 {
        margin-bottom: 1.5rem;
    }

    .mb-2 {
        margin-bottom: 1.25rem;
    }

    .mb-1 {
        margin-bottom: 1rem;
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .pb-4 {
        margin-bottom: 1.75rem;
    }

    .pb-3 {
        margin-bottom: 1.5rem;
    }

    .pb-2 {
        margin-bottom: 1.25rem;
    }

    .pb-1 {
        margin-bottom: 1rem;
    }

    .pb-0 {
        margin-bottom: 0;
    }

    table tr td,
    table tr th {
        padding: 0.3rem 0;
    }

    table tr th {
        text-align: left;
    }

    .border-bottom {
        border-bottom: 1px solid #eaeaea;
    }

    .border-bottom-bold {
        border-bottom: 2px solid #444444;
    }

    .page_break {
        page-break-before: always;
    }
</style>

<body>
    <div>
        <div class="header border-bottom-bold mb-4 pb-2">
            <table>
                <tr>
                    <td><img src="{{ asset('public/images/jalan-cantik.png') }}" alt="Logo" width="72"
                            height="72" class="d-inline-block align-text-top" style="margin-right: 14px"></td>
                    <td>
                        <div class="d-inline-block align-text-top" style="line-height:1.15">
                            <h2 class="mb-0">Jalan Cantik</h2>
                            <span style="font-size:14px">DPU Bina Marga dan Cipta Karya</span><br />
                            <span style="font-size:14px">Provinsi Jawa Tengah</span>
                        </div>
                    </td>
                <tr>
            </table>
        </div>
        <div class="mb-4" style="padding-bottom: 1.75rem">
            <div class="d-inline-flex align-item-center mb-3">
                <div
                    style="border-right: 1px solid #eaeaea; margin-right:1.5rem; margin-bottom: 10px; padding-right: 1.5rem">
                    <span class="title-primary" style="font-weight:bold; margin:0;font-size:18px">No Laporan
                        {{ $data->body->id }}
                    </span><br />
                    <span class="text-label">{{ formatDateTime($data->body->created_at) }}</span>
                </div>
                <div>
                    <span class="chip text-white bg-{{ $color[$data->body->status] }}">{{ $data->body->status }}</span>
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                    <th valign="top" width="150">Pelapor</th>
                    <td>: {{ $data->body->user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $data->body->user->email }}</td>
                </tr>
                <tr>
                    <th>No Telp</th>
                    <td>: {{ $data->body->user->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kasus</th>
                    <td>: {{ $data->body->type }}</td>
                </tr>
                <tr>
                    <th>Kabupaten / Kota</th>
                    <td>: {{ $data->body->city->name }}</td>
                </tr>
                <tr>
                    <th>Status Jalan</th>
                    <td>: {{ $data->body->status_jalan }}</td>
                </tr>
                <tr>
                    <th valign="top">Deskripsi</th>
                    <td>: {{ $data->body->info }}</td>
                </tr>
                <tr>
                    <th valign="top">Url Map</th>
                    <td>: <a
                            href="https://www.google.com/maps/search/?api=1&query={{ $data->body->latitude }},{{ $data->body->longitude }}">Google
                            Maps</a>
                    </td>
                </tr>
                <tr>
                    <th valign="top">Url Laporan</th>
                    <td>: <a href="{{ $url }}">Halaman Laporan</a></td>
                </tr>
            </table>
        </div>
        <div class="page_break"></div>
        <div>
            <span class="title-primary mb-4" style="font-weight:bold; margin:0;font-size:18px">Tindak
                Lanjut</span><br /><br />
            <div>
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
                    <div class="mb-4 border-bottom">
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
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
