let dataTable = {
    url: "",
    columns: [],
    table_id: "",
    entity: "",
    buttons: []
}

jQuery.fn.extend({
    Tables: function (property) {
        return this.each(function (index, element) {
            dataTable.url = property.url ?? ""
            dataTable.columns = property.columns ?? []
            dataTable.table_id = $(element).attr('id');
            dataTable.entity = property.entity ?? "";
            dataTable.buttons = property.buttons ?? [];
        });
    }
});

$(document).ready(async function () {
    let search = "";
    let page = "page=1";
    let selected_id = -1;


    init();
    function init() {
        if (dataTable.url == "") return;
        loadData();
    }

    function loadData() {
        var concat = dataTable.url.indexOf("?") == -1 ? "?" : "&"

        let url = dataTable.url + concat + page + "&" + search;
        loading(true)

        getData(url).then((response) => {
            loading(false)
            generateBody(response);
            generatePagination(response);
            generateTableInformation(response);

        }).catch(e => {
            loading(false)
            return;
        })
    }

    function loading(isLoading) {
        let display = isLoading ? "block" : "none";
        $("#table-loading .spinner-border").css("display", display)
    }

    function generateSerach(value) {
        if (value == undefined) return;

        if (value == "") {
            search = "";
            loadData();
            return;
        }

        let filters = [];
        dataTable.columns.forEach(col => {
            if (col == "increment" || col.includes("button")) {
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
        if (dataResponse.data.length == 0) {
            $(`#${dataTable.table_id} tbody`).html(`
            <tr>
                <td colspan="${dataTable.columns.length}" align="center">Tidak ditemukan data</td>
            </tr>
            `);
            return;
        }

        let startNumber = dataResponse.from;
        dataResponse.data.forEach((element, index) => {
            let body = `<tr class="table-content">`;
            dataTable.columns.forEach(col => {
                let value = col == "increment" ? startNumber + index : element[col];
                if (col.includes('button')) {
                    let button = generateContentButton(element, col);
                    if (button == null) return;

                    body += `<td>${button}</td>`;
                    return;
                }

                if(value == null || value == ''){
                    body += `<td>-</td>`;
                    return;
                }

                if (!Number.isInteger(value)) {
                    var date = new Date(value);
                    if (date instanceof Date && !isNaN(date)) {
                        value = date.toLocaleDateString();
                    }
                }

                let slice = 100;
                if (typeof value == "string" && value.length > slice) {
                    value = value.slice(0, slice) + " ..."
                }

                body += `<td>${value}</td>`;
            })
            body += '</tr>';
            content += body;
        });

        $(`#${dataTable.table_id} tbody`).html(content);
    }

    function generateContentButton(report, value) {
        let button_name = value.split('.')[1];
        let button = dataTable.buttons.filter(element => {
            return element.button == button_name;
        });

        if (button.length == 0) return null;

        var regExp = /\{([^)]+)\}/;
        var matches = regExp.exec(button[0].action_url);
        let action_url = button[0].action_url.replace(matches[0], report[matches[1]])
        let target = button[0].target == null ? '' : `target="${button[0]['target']}"`

        return `<a href="${action_url}" ${target} class="btn btn-outline-warning">${button[0].label}</a>`;
    }

    function generatePagination(dataResponse) {
        var data = `
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>`;

        var nav = `<nav aria-label="Page navigation example">
            <ul class="pagination">`;

        dataResponse.links.forEach((element) => {
            var label = element.label == 'pagination.previous' ?
                "Prev" :
                element.label == 'pagination.next' ?
                    "Next" :
                    element.label;

            var params = getUrlParams(element.url)

            nav += `<li class="page-item ${dataResponse.current_page == label ? 'active' : ''}" aria-current="page">
                        <button data-page="${params}" class="page-link ${params == "" ? 'disabled' : ''}  pagination-nav">${label}</button>
                    </li>`

        });
        nav += `</ul></nav>`;

        $("#table-pagination").html(nav);

        $(".pagination-nav").each(function (index, element) {
            $(element).click(function () {
                var url = $(element).data("page");
                if (url == "") return

                page = url;

                loadData()
            });
        })
    }

    function generateTableInformation(dataResponse) {
        let start = dataResponse.from ?? 0;
        let end = dataResponse.to ?? 0;
        let total = dataResponse.total ?? 0;
        let body = `${start}-${end} of ${total} items`;
       
        $("#table-information").html(body);
    }

    async function getData(fetch_url) {
        var response = $.ajax({
            url: fetch_url,
            context: document.body
        })

        return response;
    }

    function getUrlParams(url) {
        if (url == null) {
            return "";
        }

        var index = url.indexOf("?")
        return index == -1 ? "" : url.substring(index + 1);
    }

    $("#table-search-button").click(function () {
        generateSerach($("#table-search").val())
    });

    $("#table-search-clear-button").click(function () {
        $("#table-search").val("")
        generateSerach("")
    });

    $('#table-search').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            generateSerach(this.value)
        }

        event.stopPropagation();
    });
})