@extends('layouts.dashboard')
@php
$image_url = env('IMAGE_SERVER', '');

@endphp
@section('content')
<div class="row">
    <div class="col-12">
        <x-card>
            @include('pages.dashboard.laporan.fragments.filter-laporan')
        </x-card>
    </div>
    <div class="col-3">
        <div class="card shadow rounded">
            <div class="card-body p-0" id="list-of-laporan" style="max-height: calc(100vh - 300px);overflow-y: scroll;">
                <!-- Things goes here -->
            </div>
        </div>
    </div>
    <div class="col-9">
        <x-card>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#detail">Detail Laporan</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#progress">Progress</a></li>
            </ul>

            <div class="tab-content">
                <div id="detail" class="tab-pane fade in active show pt-4 pl-2">
                </div>
                <div id="progress" class="tab-pane fade pt-4 pl-2">
                </div>
            </div>
        </x-card>
    </div>
</div>

<script>
    $(document).ready(function () {
        let search = "";
        let page = "page=1";
        let loading = false;
        let data = [];
        let image_url = "{{ $image_url }}";
        let base_url = ("{{ $url }}").replace(/&amp;/g, "&");

        init();

        function init() {
            if (base_url == "") return;

            loadData();
        }

        function loadData() {
            var concat = base_url.indexOf("?") == -1 ? "?" : "&"

            let url = base_url + concat + page + "&" + search;

            getListOfData(url).then((response) => {
                data = response.body.data;
                generateBody(response);
            }).catch(e => {
                return;
            })
        }

        function generateBody(dataResponse) {
            var content = "";

            if (dataResponse.body.data.length == 0) {
                $(`#list-of-laporan`).html(`<div>Tidak ditemukan data</div>`);
                return;
            }

            let startNumber = dataResponse.body.from;
            dataResponse.body.data.forEach((element, index) => {
                let date = new Date(element['created_at']);
                let slice = 100;
                let description = element['info'].length > slice
                    ? element['info'].slice(0, slice) + " ..."
                    : element['info'];

                content += `<div class="list-container daftar-laporan" data-id="${element.id}">
                    <span class="chip float-right">Jalan Rusak</span>
                    <div class="mb-3">
                        <span class="title title-big title-primary">No Laporan ${element['id']}</span><br />
                        <span class="text-label">${date.toLocaleString()}</span>
                    </div>
                    <span class="title">Pelapor: ${element['users.name']}</span><br />
                    <span>${description}</span>
                </div>`;
            });

            $(`#list-of-laporan`).html(content);

            $(".daftar-laporan").each(function (index, element) {
                $(element).click(function () {
                    $(".daftar-laporan").each(function (i, el) {
                        $(el).removeClass("list-container-selected")
                    })

                    $(element).addClass("list-container-selected")


                    let selected_data = {};
                    data.forEach(e => {
                        if (e.id == $(element).data("id")) {
                            selected_data = e;
                            return;
                        }
                    });

                    populateDetailLaporan(selected_data);
                    populateProgressLaporan(selected_data);
                });
            })
        }

        function populateDetailLaporan(selected_data) {
            let date = new Date(selected_data['created_at']);
            let content = `<div class="d-inline-flex mb-4">
                        <div class="pr-4 mr-4" style="border-right: 1px solid #eaeaea">
                            <span class="title title-big title-primary">No Laporan ${selected_data['id']}</span><br />
                            <span class="text-label">${date.toLocaleString()}</span>
                        </div>
                        <span class="chip">${selected_data['status']}</span>
                    </div>`;

            content += `<table class="table table-borderless">
                        <tr>
                            <td valign="top" width="150">Pelapor</td>
                            <td>: ${selected_data['user']['name']}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: ${selected_data['user']['email']}</td>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td>: ${selected_data['user']['phone'] ?? "-"}</td>
                        </tr>
                        <tr>
                            <td>Kasus</td>
                            <td>: ${selected_data['type']}</td>
                        </tr>
                        <tr>
                            <td>Kabupaten / Kota</td>
                            <td>: ${selected_data['cities.name']}</td>
                        </tr>
                        <tr>
                            <td>Status Jalan</td>
                            <td>: ${selected_data['status_jalan']}</td>
                        </tr>
                        <tr>
                            <td valign="top">Deskripsi</td>
                            <td>: ${selected_data['info']}</td>
                        </tr>
                    </table>`;

            $(`#detail`).html(content);

        }

        function populateProgressLaporan(selected_data) {
            let color = { "Diterima": "secondary ", "Ditolak": 'danger', "Ditunda": 'warning', "Proses Pengerjaan": 'info', "Selesai": "success" }

            let progress = [
                {
                    "status": "Diterima",
                    "date": selected_data['created_at'],
                    "updater": "Sistem",
                    "info": "Diterima oleh sistem",
                    "color": color['Diterima'],
                    "images": [selected_data['image1'], selected_data['image2'], selected_data['image3'], selected_data['image4'], selected_data['image5'], selected_data['image6']]
                }
            ]

            selected_data.progress.forEach(element => {
                progress.push({
                    "status": element["status"] ?? '-',
                    "date": element['created_at'] ?? '-',
                    "updater": element['updater']['name'] ?? '-',
                    "info": element['info'] ?? '-',
                    "color": color[element["status"] ?? '-'],
                    "images": [element['image1'], element['image2'], element['image3'], element['image4'], element['image5'], element['image6']]
                })
            });

            let content = "";
            progress.forEach(element => {
                let images = "";
                element['images'].forEach(image => {
                    images += `
                        <img src="${image_url}${image}" class="img-thumbnail shadow mr-2 d-inline-flex" style="width:150px;height:150px;object-fit: cover;"
                            alt="${image}" />`
                });

                let date = new Date(element['date']);
                content += `<div><div class="d-inline-flex mb-4">
                        <div class="mr-4 mt-2 text-bg-${element['color']}" style="width:12px;height:12px;border-radius:100%"></div>
                        <div>
                            <div class="mb-3">
                                <span class="title title-big title-primary text-primary">${element['status']}</span><br />
                                <span class="text-label">${date.toLocaleString()}</span><br />
                            </div>
                            <div class="mb-4">
                                <span class="title title-big">${element['updater']}</span><br />
                                <span>${element['info']}</span>
                            </div>
                            <div>
                                ${images}
                            </div>
                        </div>
                        </div>
                    </div>`
            });

            $(`#progress`).html(content);
        }

        async function getListOfData(fetch_url) {
            var response = $.ajax({
                url: fetch_url,
                context: document.body
            })

            return response;
        }
    })
</script>
@endsection