<div class="table-responsive">
    <div class="d-flex justify-content-center" id="table-loading">
        <div class="spinner-border" role="status" style="position:absolute;margin-top:70px">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="form-row align-items-center">
        <div class="col-auto">
            <label class="sr-only" for="table-search">Name</label>
            <input type="text" class="form-control mb-2" id="table-search" placeholder="Cari">
        </div>
        <div class="col-auto">
            <button type="button" id="table-search-button" class="btn btn-primary mb-2">Cari</button>
        </div>
    </div>
    <table id="table" class="display table" style="width:100%">
        {{ $slot }}

    </table>

    <div id="table-pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><button class="page-link ">Previous</button></li>
                <li class="page-item"><button class="page-link ">...</button></li>
                <li class="page-item"><button class="page-link ">Next</button></li>
            </ul>
        </nav>
    </div>
</div>

<script>
    $(document).ready(async function() {
        let url = "{{ $url }}?";
        let column = "{{ $columns }}".split(",");
        let search = "";

        let dataResponse = {};

        await loadData(url);

        async function loadData(url) {
            loading(true)
            dataResponse = await getData(url)

            if (dataResponse.status_code != 200) {
                return;
            }

            loading(false)
            generateBody();
            generatePagination();
        }

        function loading(isLoading) {
            let display = isLoading ? "block" : "none";
            $("#table-loading .spinner-border").css("display", display)
        }

        async function generateSerach() {
            let filters = [];
            let value = $("#table-search").val();
            if (value == undefined) return;

            column.forEach(col => {
                filters.push(`filter[]=${col},${value}`)
            })

            url += filters.join("&");
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
            console.log()

            dataResponse.body.links.forEach((element) => {
                var label = element.label == 'pagination.previous' ?
                    "Previous" :
                    element.label == 'pagination.next' ?
                    "Next" :
                    element.label;

                var params = getUrlParams(element.url)
                var linkUrl = params == "" ? "" : url + getUrlParams(element.url);

                nav +=
                    `<li class="page-item"><button data-url="${linkUrl}" class="page-link ${params == "" ? 'disabled' : ''} ${dataResponse.body.current_page == label ? 'active' : ''} pagination-nav">${label}</button></li>`;
            });

            nav += `</ul></nav>`;
            $("#table-pagination").html(nav);

            $(".pagination-nav").each(async function(index, element) {
                $(element).click(async function() {
                    var url = $(element).data("url");
                    if (url == "") return

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
            return index == -1 ? "" : url.substring(index + 1);
        }

        $("#table-search-button").click(function() {
            generateSerach()
        });
    });
</script>