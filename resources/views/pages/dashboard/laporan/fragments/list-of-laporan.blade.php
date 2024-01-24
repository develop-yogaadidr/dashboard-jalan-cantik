@include('pages.dashboard.laporan.fragments.filter-laporan')

<div class="row">
    <div class="col-4">
        <div class="card shadow rounded">
            <div class="card-header" id="laporan-header">-</div>
            <div class="card-body p-0" id="list-of-laporan" style="max-height: calc(100vh - 300px);overflow-y: scroll;">
                <!-- Things goes here -->
            </div>
            <div class="card-footer" id="laporan-pages">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">
                                < </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#"> > </a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#detail">Detail Laporan</a>
                </li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#progress">Tindak Lanjut</a></li>
            </ul>
            <div class="card-body">
                <div class="tab-content">
                    <div id="detail" class="tab-pane fade in active show pl-2">
                        <div class="p-2">Pilih salah satu laporan</div>
                    </div>
                    <div id="progress" class="tab-pane fade pl-2">
                        <div class="p-2">Pilih salah satu laporan</div>
                    </div>
                </div>
            </div>
            <div class="card-footer" id="laporan-action-container">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
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
                generatePagination(response);
                generateTableInformation(response);
            }).catch(e => {
                return;
            })
        }

        function generateSerach(value) {
            if (value == undefined) return;

            if (value == "") {
                search = "";
                loadData();
                return;
            }

            let columns = ["reports.id", "users.name", "type", "info", "status", "status_jalan", "cities.name"]
            let filters = [];
            columns.forEach(col => {
                if (col == "increment") {
                    return;
                }

                filters.push(`filter[]=${col},${value},OR`)
            })

            page = "page=1";
            search = filters.join("&");

            loadData();
        }

        function generateBody(dataResponse) {
            var content = "";

            if (dataResponse.body.data.length == 0) {
                $(`#list-of-laporan`).html(`<div class="px-4 py-2">Tidak ditemukan data</div>`);
                return;
            }

            let startNumber = dataResponse.body.from;
            dataResponse.body.data.forEach((element, index) => {
                let date = dateToLocaleString(element['created_at']);
                let slice = 100;
                let description = element['info'].length > slice ?
                    element['info'].slice(0, slice) + " ..." :
                    element['info'];

                content += `<div class="list-container daftar-laporan" data-id="${element.id}">
                    <span class="chip float-right" style="font-size:12px">${element['type']}</span>
                    <div class="mb-3">
                        <span class="title title-big title-primary">No Laporan ${element['id']}</span><br />
                        <span class="text-label">${date.toLocaleString()}</span>
                    </div>
                    <span class="title">Pelapor: ${element['users.name']}</span><br />
                    <span>${description}</span>
                </div>`;
            });

            $(`#list-of-laporan`).html(content);

            $(".daftar-laporan").each(function(index, element) {
                $(element).click(function() {
                    $(".daftar-laporan").each(function(i, el) {
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
                    populateAction(selected_data);
                });
            })
        }

        function generatePagination(dataResponse) {
            var nav = `<nav aria-label="Page navigation example"><ul class="pagination">`;
            let side = "left";
            let left = 0;
            let right = 0;

            dataResponse.body.links.forEach((element) => {
                var label = element.label == 'pagination.previous' ?
                    "<" :
                    element.label == 'pagination.next' ?
                    ">" :
                    element.label;

                var params = getUrlParams(element.url)
                nav +=
                    `<li class="page-item"><button data-page="${params}" class="page-link ${params == "" ? 'disabled' : ''} ${dataResponse.body.current_page == label ? 'active' : ''} pagination-nav">${label}</button></li>`;
            });
            nav += `</ul></nav>`;

            $("#laporan-pages").html(nav);

            $(".pagination-nav").each(function(index, element) {
                $(element).click(function() {
                    var url = $(element).data("page");
                    if (url == "") return

                    page = url;
                    loadData()
                });
            })
        }

        function generateTableInformation(dataResponse) {
            let start = dataResponse.body.from ?? 0;
            let end = dataResponse.body.to ?? 0;
            let total = dataResponse.body.total ?? 0;
            let body = `${start}-${end} dari ${total} laporan`;
            $("#laporan-header").html(body);
        }

        function populateAction(laporan) {
            let ditolak = {
                'title': 'Ditolak',
                'icon': 'fas fa-fw fa-times',
                'color': 'btn-outline-danger'
            };
            let ditunda = {
                'title': 'Ditunda',
                'icon': 'fas fa-fw fa-exclamation',
                'color': 'btn-outline-secondary'
            };
            let selesai = {
                'title': 'Selesai',
                'icon': 'fas fa-fw fa-check',
                'color': 'btn-outline-success'
            };
            let proses = {
                'title': 'Proses Pengerjaan',
                'icon': 'fas fa-fw fa-wrench',
                'color': 'btn-outline-info'
            };

            let actions = {
                'Diterima': [ditolak, ditunda, proses, selesai],
                'Ditunda': [proses, selesai],
                'Proses Pengerjaan': [selesai],
                'Ditolak': [],
                'Selesai': [],
            };

            let action = actions[laporan.status];

            let content = '';
            action.forEach(e => {
                content += `<a href="{{ URL::to('/') }}/dashboard/laporan/${laporan.id}/${e.title}"
                    class="btn btn-sm ${e.color} mr-2"> <i class="${e.icon}"></i>
                    ${e.title}</a>`
            });
            $(`#laporan-action-container`).html(content);
        }

        function populateDetailLaporan(selected_data) {
            let date = dateToLocaleString(selected_data['created_at']);
            let content = `<div class="d-inline-flex mb-4">
                        <div class="pr-4 mr-4" style="border-right: 1px solid #eaeaea">
                            <span class="title title-big title-primary">No Laporan ${selected_data['id']}</span><br />
                            <span class="text-label">${date.toLocaleString()}</span>
                        </div>
                        <div>
                            <a href="{{ URL::to('/') }}/dashboard/laporan/${selected_data['id']}/download" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Download PDF</a>
                        </div>
                    </div>`;

            content += `<table class="table table-borderless">
                        <tr>
                            <td valign="top" width="150">Pelapor</td>
                            <td>: ${selected_data['users.name']}</td>
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

            content += `<iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyClpmIku9wq1BhREuGbxog7qjnT9Wfm02Y&q=${selected_data.latitude},${selected_data.longitude}">
                        </iframe>`;

            $(`#detail`).html(content);

        }

        function populateProgressLaporan(selected_data) {
            let color = {
                "Diterima": "secondary",
                "Ditolak": 'danger',
                "Ditunda": 'warning',
                "Proses Pengerjaan": 'info',
                "Selesai": "success"
            }
            let progress = [{
                "status": "Diterima",
                "date": selected_data['created_at'],
                "updater": "Sistem",
                "info": 'Diterima sistem.',
                "color": color['Diterima'],
                "images": ([selected_data['image1'], selected_data['image2'], selected_data['image3'],
                    selected_data['image4'], selected_data['image5'], selected_data['image6']
                ]).filter(e => {
                    return e !== null
                })
            }]

            selected_data.progress.forEach(element => {
                progress.push({
                    "status": element["status"] ?? '-',
                    "date": element['created_at'] ?? '-',
                    "updater": element['updater']['name'] ?? '-',
                    "info": element['info'] ?? '-',
                    "color": color[element["status"] ?? '-'],
                    "images": ([element['image1'], element['image2'], element['image3'],
                        element['image4'], element['image5'], element['image6']
                    ]).filter(e => {
                        return e !== null
                    })
                })
            });

            let content = "";
            progress.forEach(element => {
                let images = "";
                element['images'].forEach(image => {
                    images += `
                        <img src="${image_url}${image}" class="img-thumbnail shadow mr-2 mb-3 d-inline-flex" style="width:150px;height:150px;object-fit: cover;"
                            alt="${image}" />`
                });

                let date = dateToLocaleString(element['date']);
                content += `<div><div class="d-inline-flex mb-4">
                        <div class="mr-4 mt-2 text-bg-${element['color']}" style="width:12px;height:12px;border-radius:100%"></div>
                        <div>
                            <div class="mb-3">
                                <span class="title title-big title-primary text-${element['color']}">${element['status']}</span><br />
                                <span class="text-label">${date}</span><br />
                            </div>
                            <div class="mb-4">
                                <span class="title title-big">${element['updater']}</span><br />
                                <span>${element['info']}</span>
                            </div>
                            <div class="report-image-gallery" id="gallery-${element['status'].replace(" ", "-").toLowerCase()}">
                                ${images}
                            </div>
                        </div>
                        </div>
                    </div>`
            });

            $(`#progress`).html(content);
            $(".report-image-gallery").each((index, element) => {
                $(element).Gallery({})
            })
        }

        function getUrlParams(url) {
            if (url == null) {
                return "";
            }

            var index = url.indexOf("?")
            return index == -1 ? "" : url.substring(index + 1);
        }

        async function getListOfData(fetch_url) {
            var response = $.ajax({
                url: fetch_url,
                context: document.body
            })

            return response;
        }

        $("#laporan-search-button").click(function() {
            generateSerach($("#laporan-search").val())
        });

        $("#laporan-clear-search-button").click(function() {
            let value = $("#laporan-search").val();
            if (value == '' || value == null) {
                return;
            }

            $("#laporan-search").val('');
            generateSerach('')
        });

        $('#laporan-search').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                generateSerach(this.value)
            }

            event.stopPropagation();
        });
    })
</script>
