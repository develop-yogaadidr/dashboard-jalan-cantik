@extends ('layouts.app-with-header')

@section('content')
    <div class="container pb-5" id="container">
        {{-- <x-card>
            <div class="row gy-3">
                <div class="col-md-3">
                    <select class="form-select" aria-label="Default select example">
                        <option value="">Tampilkan Semua</option>
                        @foreach ($cards as $card)
                            <option value="{{ $card['data'] }}">{{ $card['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="text" id="table-search" class="form-control bg-light" placeholder="Cari laporan"
                            aria-label="cari laporan" aria-describedby="button-cari-laporan">
                        <button id="table-search-clear-button" class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                        <button id="table-search-button" class="btn btn-success" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </x-card> --}}

        @foreach ($cards as $card)
            <a href="{{ $card['target'] }}" class="link-dark text-decoration-none" id="{{ $card['id'] }}">
                <x-card class="p-3 hover-scale">
                    <div class="text-center mb-5">
                        <h4>{{ $card['title'] }}</h4>
                        <h5><span class="badge bg-info rounded-pill" id="{{ $card['id'] }}-counter">0</span></h5>
                    </div>
                    <div class="row gy-5">
                        <div class="col-md-6 col-sm-120">
                            <div id="{{ $card['id'] }}-buttons" class="row gy-3 mb-4">
                            </div>
                            <div style="width:450px;margin:auto" id="{{ $card['id'] }}-graph-container">
                                <canvas id="{{ $card['id'] }}-graph" width="200px" height="100px"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-120" id="{{ $card['id'] }}-type"></div>
                    </div>
                </x-card>
            </a>
        @endforeach
    </div>

    <script>
        $(document).ready(function() {
            let cards = <?= json_encode($cards) ?>;
            let base_url = ("{{ $url }}").replace(/&amp;/g, "&");

            init();

            function init() {
                if (base_url == "") return;

                loadData();
            }

            function loadData() {
                cards.forEach(async element => {
                    getListOfData(`${base_url}/${element.url}`)
                        .then((response) => {
                            populateReport(response, element.id)
                        }).catch(e => {
                            return;
                        });
                });
            }

            async function getListOfData(fetch_url) {
                var response = $.ajax({
                    url: fetch_url,
                    context: document.body
                })

                return response;
            }

            function populateReport(response, card_id) {
                $(`#${card_id}-counter`).html(response.total.counter);

                populateButton(response, card_id)
                populateGraph(response, card_id)
                populateKeteranganLaporan(response, card_id)
            }

            function populateButton(response, id) {
                let button = ``;
                response.status_counter.forEach(element => {
                    if (element.label != "Diterima") {
                        button +=
                            `<div class="col-6"><span class="btn btn-warning btn-block pe-none shadow shadow-sm rounded py-2">${element.label} <span class="badge badge-danger">${element.counter}</span></span></div>`
                    }
                });

                $(`#${id}-buttons`).html(button);
            }

            function populateGraph(response, id) {
                if (response.kinerja.total == 0) {
                    $(`#${id}-graph-container`).html(
                        `<div class="text-center text-small">Belum ada data kinerja penyelesaian</div>`);
                    return;
                }

                const ctx = document.getElementById(`${id}-graph`);
                let labels = response.kinerja.data.map(e => {
                    return e.label
                })

                let percentage = response.kinerja.data.map(e => {
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

            function populateKeteranganLaporan(response, id) {
                let content = `<div class="row gy-2">`;
                response.type_counter.forEach(element => {
                    content += `<div class="col-4 text-center position-relative">
                    <span class="position-absolute top-0 start-10 translate-middle badge rounded-pill bg-danger">${element.counter}</span>
                    <img src="${element.icon}" class="img-thumbnail shadow shadow-sm mr-2 d-inline-flex mb-1" style="width:100px;height:100px;object-fit: cover;"
                            alt="${element.label}" />
                            <p>${element.label}</p>
                    </div > `
                });
                content += `</div > `;

                $(`#${id}-type`).html(content);
            }
        });
    </script>
@endsection
