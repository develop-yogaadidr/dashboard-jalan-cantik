@extends('layouts.dashboard')

@section('content')
<x-card>
    <div class="table-responsive">
        <table id="table" class="display table" style="width:100%">
            <thead></thead>
            <tbody></tbody>
        </table>
        <div id="table-pagination"></div>
        <button id="pagination" data-role="xx" type="button">asdasd</button>
    </div>
</x-card>

<script>
    $(document).ready(async function() {
        let url = "{{ $url }}";
        let column = [{
                src: "name",
                label: "Nama"
            },
            {
                src: "email",
                label: "Email"
            },
            {
                src: "role",
                label: "Role"
            }
        ]

        let dataResponse = {};

        await loadData(url);

        async function loadData(url) {
            dataResponse = await getData(url)
            if (dataResponse.status_code != 200) {
                return;
            }

            generateHeader();
            generateBody();
            generatePagination();
        }

        function generateHeader() {
            let header = `<tr>`;
            column.forEach(element => {
                header += `<th>${element.label}</th>`
            });

            header += `</tr>`;
            $("#table thead").append(header);
        }

        async function generateBody() {
            dataResponse.body.data.forEach((element) => {
                let body = '<tr>';
                column.forEach(col => {
                    body += `<td>${element[col.src]}</td>`;
                })
                body += '</tr>';

                $("#table tbody").append(body);
            });
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

                nav += `<li class="page-item"><button id="paginationNav" data-role="xxx" class="page-link">${label}</button></li>`;
            });

            nav += `</ul></nav>`;

            $("#table-pagination").append(nav);
        }

        async function getData(fetch_url) {
            return $.ajax({
                url: fetch_url,
                context: document.body
            })
        }

        ;
        $("#paginationNav").each(index => {
            $("#paginationNav").click(function() {
                var data = $(this).data("role");
                console.log(index);

            });
        });

    });
</script>
@endsection