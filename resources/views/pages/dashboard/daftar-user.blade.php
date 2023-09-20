@extends('layouts.dashboard')

@section('content')
    <x-card>
        <div class="table-responsive">
            <table id="table" class="display table" style="width:100%">
                <thead>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                </thead>
                <tbody></tbody>
            </table>
            <div id="table-pagination"></div>
        </div>
    </x-card>

    <script>
        $(document).ready(async function() {
            let url = "{{ $url }}";
            let column = ["name", "email", "role"]

            let dataResponse = {};

            await loadData(url);

            async function loadData(url) {

                dataResponse = await getData(url)
                console.log(dataResponse);

                if (dataResponse.status_code != 200) {
                    return;
                }

                generateBody();
                generatePagination();
            }

            async function generateBody() {
                var content = "";
                dataResponse.body.data.forEach((element) => {
                    let body = '<tr>';
                    column.forEach(col => {
                        body += `<td>${element[col]}</td>`;
                    })
                    body += '</tr>';
                    content += body;
                });

                $("#table tbody").html(content);
            }

            async function generatePagination() {
                var nav = `<nav aria-label="Page navigation example">
                <ul class="pagination">`;

                dataResponse.body.links.forEach((element) => {
                    var label = element.label == 'pagination.previous' ?
                        "Previous" :
                        element.label == 'pagination.next' ?
                        "Next" :
                        element.label;

                    var linkUrl = url + getUrlParams(element.url);
                    nav +=
                        `<li class="page-item"><button data-url="${linkUrl}" class="page-link pagination-nav">${label}</button></li>`;
                });

                nav += `</ul></nav>`;
                $("#table-pagination").html(nav);

                $(".pagination-nav").each(async function(index, element) {
                    $(element).click(async function() {
                        console.log(index)
                        var url = $(element).data("url");
                        await loadData(url)
                    });
                })
            }

            async function getData(fetch_url) {
                return $.ajax({
                    url: fetch_url,
                    context: document.body
                })
            }

            function getUrlParams(url) {
                if (url == null) {
                    return "";
                }

                var index = url.indexOf("?")
                return index == -1 ? "" : url.substring(index);
            }
        });
    </script>
@endsection
