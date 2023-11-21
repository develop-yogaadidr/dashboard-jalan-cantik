@extends ('layouts.app-with-header')

@php

$cards = [
[
'id' => 'card-jalan-tol',
'title' => 'Jalan Tol',
],
[
'id' => 'card-jalan-nasional',
'title' => 'Jalan Nasional',
],
[
'id' => 'card-jalan-provinsi',
'title' => 'Jalan Provinsi',
],
[
'id' => 'card-jalan-kabupaten-kota',
'title' => 'Jalan Kabupaten/Kota',
],
[
'id' => 'card-jalan-desa',
'title' => 'Jalan Desa',
],
];

@endphp

@section('content')
<div class="container pb-5" id="container">
    @foreach ($cards as $card)
    <x-card id="{{ $card['id'] }}" class="p-3">
        <div class="text-center mb-5">
            <h4>{{ $card['title'] }}</h4>
            <h5><span class="badge bg-success rounded-pill" id="{{ $card['id'] }}-counter">0</span></h5>
        </div>
        <div class="row gy-5">
            <div class="col-md-6 col-sm-120">
                <div id="{{ $card['id'] }}-buttons" class="row gy-3 mb-4">
                </div>
                <div style="width:450px;margin:auto">
                    <canvas id="{{ $card['id'] }}-graph" width="200px" height="100px"></canvas>
                </div>
            </div>
            <div class="col-md-6 col-sm-120" id="{{ $card['id'] }}-type"></div>
        </div>
    </x-card>
    @endforeach

</div>

<script>
    $(document).ready(function () {
        let status_jalans = ["Tol", "Nasional", "Provinsi", "Kabupaten/Kota", "Desa"];
        // let status_jalans = ["Tol"];
        let base_url = ("{{ $url }}").replace(/&amp;/g, "&");

        init();

        function init() {
            if (base_url == "") return;

            loadData();
        }

        function loadData() {
            status_jalans.forEach(async element => {
                let status_jalan = element.replace("/", "")
                getListOfData(`${base_url}/${status_jalan}`)
                    .then((response) => {
                        populateReport(response, element)
                    }).catch(e => {
                        return;
                    })
            });
        }

        async function getListOfData(fetch_url) {
            var response = $.ajax({
                url: fetch_url,
                context: document.body
            })

            return response;
        }

        function populateReport(response, status_jalan) {
            let base_id = `card-jalan-${status_jalan.toLowerCase().replace("/", "-")}`
            $(`#${base_id}-counter`).html(response.total.counter);

            let url = `{{URL::to('/')}}/laporan-masuk?selected_status_jalan=${status_jalan}`;

            populateButton(response, base_id, url)
            populateGraph(response, base_id)
            populateKeteranganLaporan(response, base_id, url)
        }

        function populateButton(response, id, url) {
            let button = ``;
            response.status_counter.forEach(element => {
                if (element.label != "Diterima") {
                    button += `<div class="col-6"><a href="${url}&selected_status=${element.label}" class="btn btn-warning btn-block shadow shadow-sm rounded py-2">${element.label} (${element.counter})</a></div>`
                }
            });

            $(`#${id}-buttons`).html(button);
        }

        function populateGraph(response, id) {
            const ctx = document.getElementById(`${id}-graph`);
            let labels = response.kinerja.map(e => {
                return e.label
            })

            let percentage = response.kinerja.map(e => {
                return e.percentage
            })

            new Chart(ctx, {
                type: 'doughnut',

                data: {
                    labels: labels,
                    datasets: [{
                        label: '%',
                        data: percentage,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            text: "Kinerja Penyelesaian",
                            display: true,
                            fullSize: true
                        },
                        layout: {
                            padding: 20
                        },
                        legend: {
                            title: {
                                display: true,
                                text: "Keterangan"
                            },
                            position: 'right',
                            display: true,

                        }
                    }
                }
            });
        }

        function populateKeteranganLaporan(response, id, url) {
            let content = `<div class="row gy-2">`;
            response.type_counter.forEach(element => {
                content += `<div class="col-4 text-center position-relative">
                    <span class="position-absolute top-0 start-10 translate-middle badge rounded-pill bg-danger">${element.counter}</span>
                    <a href="${url}&selected_kasus=${element.label}"><img src="${element.icon}" class="img-thumbnail shadow shadow-sm mr-2 d-inline-flex mb-1" style="width:100px;height:100px;object-fit: cover;"
                            alt="${element.label}" /></a>
                            <p>${element.label}</p>
                    </div > `
            });
            content += `</div > `;

            $(`#${id}-type`).html(content);
        }
    });
</script>
@endsection