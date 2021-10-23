$(function () {
    $.extend({
        url: window.location.href + "/search",
        update_order_url: window.location.href + "/update-order",
        params: {},
        searchList: function (url) {
            let _url = url ? url : $.url;
            let base_url = localStorage.getItem("url");
            if (_url.indexOf(base_url) >= 0) {
                $.params["page"] = localStorage.getItem("page");
            } else {
                $.params["page"] = 1;
                localStorage.removeItem("url");
                localStorage.removeItem("page");
            }

            let _param = $.param($.params);
            if (Object.keys(_param).length) {
                if (_url.indexOf("?") >= 0) {
                    _url = _url + "&" + _param;
                } else {
                    _url = _url + "?" + _param;
                }
            }
            if ($("#search-result").length) {
                $("#page-overlay").show();
                $.get(_url).then(function (data) {
                    if (!data.search_result) {
                        alert("Không tìm thấy dữ liệu nào.");
                    }

                    $("#search-result").html(data.search_result);
                    $("#pagination").html(data.pagination);
                    $("#total-record").html(data.total);
                    $("#page-overlay").hide();
                });
            }
        },
        updateOrder: function() {
            let update_orders = [];
            $(".update-order").each(function () {
                let id = $(this).attr("data-id");
                let order = $(this).val();
                let bef_order = $(`#update_order_hidden_${id}`).val();
                if (order !== bef_order) {
                    update_orders.push({
                        id: id,
                        order: order,
                    });
                }
            });

            $.post({
                url: $.update_order_url,
                data: { update_orders: update_orders },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            }).then(function (res) {
                console.log(res);
                $.searchList();
            });
        }
    });

    $.searchList();

    $(document).on("click", "#reload", function () {
        $.searchList();
    });

    $(document).on("click", ".page-link", function () {
        let page = $(this).attr("data-page");
        localStorage.setItem("url", window.location.href);
        localStorage.setItem("page", page);
        $.params["page"] = page;
        $.searchList();
    });

    $(document).on("click", "#search-btn", function () {
        localStorage.setItem("page", 1);
        let keyword = $("#search-form").serialize();
        let params = Object.fromEntries(new URLSearchParams(keyword));
        $.params = { ...params };
        $.searchList();
    });

    $(document).on("click", "#create-btn", function () {
        localStorage.removeItem("url");
        localStorage.removeItem("page");
        window.open($("#create_url").val(), "_self");
    });

    $(document).on("click", "#update-order-btn", function () {
        $.updateOrder();
    });

    $(document).on("click", "#check-all", function (e) {
        $(".primary-id").not(this).prop("checked", this.checked);
    });

    $("#remove-btn").click(function (e) {
        let hasChecked = $(".primary-id:checked").length;
        if (!hasChecked) {
            return false;
        }

        if (!confirm("Are you sure want to delete " + hasChecked + " items?")) {
            return false;
        }

        let ids = [];
        $(".primary-id:checked").each(function () {
            ids.push($(this).val());
        });

        if (!$("#remove_url").length) {
            alert("Server not found!");
            return false;
        }

        let url = $("#remove_url").val();

        $.post({
            url: url,
            data: { ids: ids },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        }).then(function () {
            $.searchList();
        });
    });
});
