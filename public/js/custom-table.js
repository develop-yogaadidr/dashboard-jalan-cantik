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
            dataTable.buttons = property.buttons;
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
        generateButtons();
    }

    function loadData() {
        var concat = dataTable.url.indexOf("?") == -1 ? "?" : "&"

        let url = dataTable.url + concat + page + "&" + search;
        loading(true)
        updateActionButtonDisableProperty(true)

        getData(url).then((response) => {
            loading(false)
            generateBody(response);
            generatePagination(response);
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

        if(value == ""){
            search = "";
            loadData();
            return;
        }

        let filters = [];
        dataTable.columns.forEach(col => {
            if (col == "increment") {
                return;
            }

            if (col.indexOf(".") == -1) {
                let col_name = dataTable.entity == "" ? col : `${dataTable.entity}.${col}`
                filters.push(`filter[]=${col_name},${value},OR`)
            } else {
                let words = col.split(".");
                filters.push(`where_has[]=${words[0]},${words[1]},${value},OR`)
            }
        })

        search = filters.join("&");

        loadData();
    }

    function generateBody(dataResponse) {
        var content = "";

        if (dataResponse.body.data.length == 0) {
            $(`#${dataTable.table_id} tbody`).html(`
            <tr>
                <td colspan="${dataTable.columns.length}" align="center">Tidak ditemukan data</td>
            </tr>
            `);
            return;
        }

        let startNumber = dataResponse.body.from;
        dataResponse.body.data.forEach((element, index) => {
            let body = `<tr class="table-content" data-id="${element.id}">`;
            dataTable.columns.forEach(col => {
                // TODO: revisit then
                let column = col.split(".")
                let value = col == "increment" ? startNumber + index :
                    column.length == 1 ? element[column[0]] : element[column[0]][column[1]]

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

        $(".table-content").each(function (index, element) {
            $(element).click(function () {
                selected_id = $(element).data("id");

                $(".table-content").each(function (i, el) {
                    $(el).removeClass("table-primary")
                })

                $(element).addClass("table-primary")

                updateActionButtonDisableProperty(false)
            });
        })
    }

    function generatePagination(dataResponse) {
        var nav = `<nav aria-label="Page navigation example">
            <ul class="pagination">`;

        dataResponse.body.links.forEach((element) => {
            var label = element.label == 'pagination.previous' ?
                "Previous" :
                element.label == 'pagination.next' ?
                    "Next" :
                    element.label;

            var params = getUrlParams(element.url)

            nav +=
                `<li class="page-item"><button data-page="${params}" class="page-link ${params == "" ? 'disabled' : ''} ${dataResponse.body.current_page == label ? 'active' : ''} pagination-nav">${label}</button></li>`;
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

    function generateButtons() {
        dataTable.buttons.forEach(element => {
            $(`#table-${element.button}-button`).data('url', element.action_url).css("display", "inline")
        })

        $(".table-action-button").each((index, element) => {
            $(element).click(() => {
                location.href = $(element).data("url") + "/" + selected_id;
            })
        })
    }

    function updateActionButtonDisableProperty(value) {
        $(".table-action-button").each(function () {
            $(this).prop('disabled', value);
        });
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

    $('#table-search').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            generateSerach(this.value)
        }

        event.stopPropagation();
    });
})