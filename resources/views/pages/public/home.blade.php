@extends('layouts.app-home')
@php
    $link_laporan_kerusakan = [
        'Laporan Masuk' => URL::to('/') . '/laporan-masuk',
        'Laporan Diterima AI' => URL::to('/') . '/laporan-diterima-ai',
        'Laporan Ditolak AI' => URL::to('/') . '/laporan-ditolak-ai',
    ];

    $link_laporan_publik = [
        'Diterima' => URL::to('/') . '/laporan-masuk?selected_status=Diterima',
        'Proses Pengerjaan' => URL::to('/') . '/laporan-masuk?selected_status=Proses Pengerjaan',
        'Ditolak' => URL::to('/') . '/laporan-masuk?selected_status=Ditolak',
        'Ditunda' => URL::to('/') . '/laporan-masuk?selected_status=Ditunda',
        'Selesai' => URL::to('/') . '/laporan-masuk?selected_status=Selesai',
    ];
@endphp

@section('content')
    <style>
        .header {
            height: calc(100vh - 100px);
            width: 100vw;
            background: black;
            overflow: hidden;
            position: relative;
        }

        .header-image {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        .header-tagline {
            position: absolute;
            top: 40%;
            left: 35%;
            transform: translate(-50%, -50%);
            max-width: 800px;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        .header-info {
            position: absolute;
            top: 20%;
            right: 10%;
            color: #fff;
            font-family: 'Roboto', sans-serif;
            align-items: center;
        }

        .header-info-content {
            width: 450px;
            height: 450px;
            position: relative;
            background-image: url("{{ URL::to('/') . '/public/images/liquid.png' }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .header-info-content img {
            width: 150px;
            position: absolute;
            left: -60px;
            top: 100px;
            transform: rotate(-5deg);
        }

        #map {
            height: calc(100vh - 130px);
            z-index: 9;
        }

        .map-title {
            position: absolute;
            z-index: 99;
            border-radius: 100px;
            top: 50px;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fbd12d;
            padding: 12px 24px;
            font-size: 18px;
        }

        @media all and (max-width: 670px) {
            #map {
                margin-top: 190px;
            }
        }
    </style>
    <section class="header mb-5">
        <img class="header-image" src="{{ URL::to('/') . '/public/images/beranda.png' }}" alt="Five developers at work.">
        <div class="header-tagline">
            <p class="text-white font-weight-bold h2 mb-4 lh-base">Mari Kita Bangun Bersama Provinsi Jawa Tengah<br />
                Dengan Melaporkan Jalan<br />
                & Jembatan yang Rusak</p>
            <a href="{{ URL::to('/') . '/kontak' }}" class="btn btn-danger btn-xl">Kontak Kami</a>
        </div>
        <div class="header-info">
            <div class="header-info-content">
                <img src="{{ URL::to('/') . '/public/images/mockups/home.png' }}">
                <div style="position: absolute;width: 300px;top: 90px;left: 100px;">
                    <h4 class="font-weight-bold h3">Jalan Cantik</h4>
                    <p class="text-white mb-5 h5 lh-base">Aplikasi yang berfungsi untuk melaporkan kerusakan jalan dan
                        jembatan
                        di
                        wilayah Provinsi Jawa Tengah</p>
                    <a href="" class="btn btn-warning mr-2">Selengkapnya</a>
                    <a href="{{ URL::to('/') . '/download' }}" class="btn btn-danger"><i class="fa fa-download"></i>
                        Download</a>
                </div>
            </div>
        </div>
    </section>
    <section class="map mb-4">
        <div class="container">
            <div class="card shadow">
                <div class="map-title shadow">Mari kita bangun bersama Provinsi Jawa Tengah</div>
                <div class="callbacks_container">
                    <div id="map"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <section class="p-5">
        <div class="container">
            <x-card class="p-5 text-center">
                <div class="d-inline-flex mb-5">
                    <img src="{{ URL::to('/') . '/public/images/blog.png' }}" style="height:80px" class="mr-3">
                    <div class="text-center h3 lh-base mb-4">Laporan Kerusakan di <br />Provinsi Jawa Tengah</div>
                </div>
                <div class="row justify-content-md-center">
                    @foreach ($counter['total']->body as $element)
                        <div class="col-3">
                            <a href="{{ $link_laporan_kerusakan[$element->label] }}"
                                class="card card-counter text-decoration-none shadow link-dark hover-scale">
                                <div class="card-body text-center">
                                    <h2 class="counter">{{ $element->counter }}</h2>
                                    <span>{{ $element->label }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <x-card class="p-5 text-center">
                <div class="d-inline-flex mb-5">
                    <div class="text-center h3 lh-base mb-4">Laporan Publik</div>
                </div>
                <div class="row gy-4 justify-content-md-center">
                    @foreach ($counter['publik']->body->details as $element)
                        <div class="col-4">
                            <a href="{{ $link_laporan_publik[$element->label] }}"
                                class="card card-counter text-decoration-none shadow link-dark hover-scale">
                                <div class="card-body text-center">
                                    <h2 class="counter">{{ $element->counter }}</h2>
                                    <span>{{ $element->label }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>
    </section>

    <script>
        $(document).ready(() => {
            var map = L.map('map', {
                    zoom: 9,
                    attributionControl: false,
                    center: L.latLng([-7.2990068, 110.0637878])
                }),
                osmLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

            map.addLayer(osmLayer);

            var baseLayers = [{
                name: "OpenStreetMap",
                layer: osmLayer
            }];

            function icon(color) {
                return '<i class="fas fa-home"></i>';
            }

            function pointer(color) {
                return '<div style="background-color:' + color +
                    ';width:16px;height:16px;border-radius:100%;margin-right:8px"></div>';
            }

            function featureToMarker(feature, latlng) {
                return L.marker(latlng, {
                    icon: L.divIcon({
                        className: 'marker-' + feature.properties.amenity,
                        html: iconByName(feature.properties.amenity),
                        iconUrl: '../images/markers/' + feature.properties.amenity + '.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                });
            }

            function popUpJalanProvinsi(f, l) {
                var html = '';

                if (f.properties) {
                    html += '<table class="table">';
                    html += '<thead class="thead-dark">';
                    html += '<tr><th scope="col">Nama Ruas</th>';
                    html += '<th scope="col">' + f.properties['Nm_Ruas'] + '</th></tr>';
                    html += '</thead><tbody>';
                    html += '<tr><th scope="row">Kab/Kot</th>';
                    html += '<td>' + f.properties['Kab_Kot'] + '</td></tr>';
                    html += '<tr><th scope="row">Kecamatan</th>';
                    html += '<td>' + f.properties['Kecamatan'] + '</td></tr>';
                    html += '<tr><th scope="row">Desa/Kel</th>';
                    html += '<td>' + f.properties['Desa_Kel'] + '</td></tr>';
                    html += '<tr><th scope="row">Status</th>';
                    html += '<td>' + f.properties['Status'] + '</td></tr>';
                    html += '<tr><th scope="row">Provinsi</th>';
                    html += '<td>' + f.properties['Propinsi'] + '</td></tr>';
                    html += '</tbody>';
                    html += '</table>';
                    l.bindPopup(html);
                }
            }

            function popUpJalanKota(f, l) {
                var html = '';

                if (f.properties) {
                    html += '<table class="table">';
                    html += '<thead class="thead-dark">';
                    html += '<tr><th scope="col">Nama Ruas</th>';
                    html += '<th scope="col">' + f.properties['NAMA_RUAS'] + '</th>';
                    html += '</thead>';
                    html += '<tr><th scope="col">Panjang</th>';
                    html += '<th scope="col">' + f.properties['Panjang'] + ' km</th></tr>';
                    html += '</table>';
                    l.bindPopup(html);
                }
            }

            function popUpJalanNasional(f, l) {
                var html = '';

                if (f.properties) {
                    html += '<table class="table">';
                    html += '<thead class="thead-dark">';
                    html += '<tr><th scope="col">Nama Ruas</th>';
                    html += '<th scope="col">' + f.properties['NAMA_RUAS'] + '</th>';
                    html += '</thead>';
                    html += '<tr><th scope="col">Panjang</th>';
                    html += '<th scope="col">' + f.properties['Panjang'].toFixed(2) + ' km</th></tr>';
                    html += '<tr><th scope="col">Nomor ruas</th>';
                    html += '<th scope="col">' + f.properties['KodeNas'] + '</th></tr>';
                    html += '</table>';
                    l.bindPopup(html);
                }
            }

            function popUpBatasBpj(f, l) {
                var html = '';

                if (f.properties) {
                    html += '<table>';
                    html += '<tr>';
                    html += '<td>' + f.properties['Name'] + '</td>';
                    html += '</tr>';
                    html += '</table>';
                    l.bindPopup(html);
                }
            }

            function getStyle(color) {
                return {
                    "color": color,
                    "weight": 4,
                    "opacity": 1
                }
            }

            function getGeoInfoLines(property) {
                let geoInfo = new L.GeoJSON.AJAX([property.url], {
                    onEachFeature: property.action,
                    style: getStyle(property.color),
                    pointToLayer: featureToMarker
                })

                return {
                    name: property.name,
                    icon: pointer(property.color),
                    layer: property.open_default ? geoInfo.addTo(map) : geoInfo
                }
            }

            function getGeoInfoPoint(property) {
                let geoInfo = new L.GeoJSON.AJAX([property.url], {
                    onEachFeature: function(feature, layer) {
                        if (feature.properties && feature.properties.name) {
                            layer.bindPopup(feature.properties.popup);
                        }
                    },
                    style: getStyle(property.color),
                    pointToLayer: function(feature, latlng) {
                        return L.marker(latlng, {
                            icon: new L.icon({
                                iconUrl: "{{ asset('public/images/marker.png') }}",
                                iconSize: [30, 30]
                            })
                        });
                    }
                })

                return {
                    name: property.name,
                    icon: pointer(property.color),
                    layer: property.open_default ? geoInfo.addTo(map) : geoInfo
                }
            }

            var jalanKabKota = <?= json_encode($cities) ?>;
            let overLayers = [{
                    group: "Jalan",
                    collapsed: true,
                    layers: [
                        getGeoInfoLines({
                            name: "Jalan Provinsi",
                            url: "{{ asset('public/geojson/jalan_provinsi.geojson') }}",
                            color: "#0000ff",
                            action: popUpJalanProvinsi,
                            open_default: true
                        }),
                        getGeoInfoLines({
                            name: "Jalan Nasional",
                            url: "{{ asset('public/geojson/jalan_nasional.geojson') }}",
                            color: "#f60404",
                            action: popUpJalanNasional,
                            open_default: true
                        }),
                    ]
                },
                {
                    group: "Titik Laporan",
                    collapsed: true,
                    layers: jalanKabKota.body.map((element) => {
                        return getGeoInfoPoint({
                            name: element.name,
                            url: `{{ env('SERVER_URL', '') }}/public/reports/geojson/${element.id}`,
                            color: "#35CA3D"
                        })
                    })
                },
                {
                    group: "Jalan Kabupaten Kota",
                    collapsed: true,
                    layers: jalanKabKota.body.map((element) => {
                        let nama = element.name.replace(" ", "_").replace(".", "").toLowerCase();
                        return getGeoInfoLines({
                            name: element.name,
                            url: "{{ asset('public/geojson/kab_kota') }}" + `/${nama}.geojson`,
                            color: "#111111",
                            action: popUpJalanKota,
                            open_default: false
                        })
                    })
                },
                {
                    group: "Batas BPJ",
                    collapsed: true,
                    layers: [getGeoInfoLines({
                        name: "Batas BPJ",
                        url: "{{ asset('public/geojson/batas_BPJ.geojson') }}",
                        color: "#35CA3D",
                        action: popUpBatasBpj,
                        open_default: false
                    })]
                }
            ]

            if (document.body.clientWidth <= 767) {
                var isCollapsed = true;
            } else {
                var isCollapsed = false;
            }

            var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers, {
                collapsibleGroups: true,
                collapsed: isCollapsed
            });

            map.addControl(panelLayers);
        })
    </script>
@endsection
