@extends('layouts.dashboard')

@section('content')
<x-card>
    <div class="table-responsive">
        <table id="table" class="display" style="width:100%">
            <thead></thead>
            <tbody></tbody>
        </table>
        <div id="pagination"></div>
    </div>
</x-card>


<script>
    $(document).ready(async function() {
        let base_url = "{{ URL::to('/') }}" + "/dashboard/data/user";
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
        let dataResponse = await getData();

        generateHeader();
        generateBody();
        generatePagination();

        function generateHeader() {
            let header = `<tr>`;
            column.forEach(element => {
                header += `<th>${element.label}</th>`
            });

            header += `</tr>`;
            $("#table thead").append(header);
        }

        async function generateBody() {
            if (dataResponse.status_code != 200) {
                return;
            }

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
        }

        async function getData() {
            return $.ajax({
                url: base_url,
                context: document.body
            })
        }
    });
</script>
@endsection