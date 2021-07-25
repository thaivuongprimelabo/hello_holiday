$(function () {
    $.extend({
        url: window.location.href + "/search",
        params: {},
        searchList: function (url) {
            let _url = url ? url : $.url;
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
                    $("#search-result").html(data.search_result);
                    $("#pagination").html(data.pagination);
                    $("#total-record").html(data.total);
                    $("#page-overlay").hide();
                });
            }
        },
    });

    $.searchList();

    $(document).on("click", "#reload", function () {
        $.searchList();
    });

    $(document).on("click", ".page-link", function () {
        let page = $(this).attr("data-page");
        $.params["page"] = page;
        $.searchList();
    });

    $(document).on("click", "#search-btn", function () {
        let keyword = $("#search-form").serialize();
        let params = Object.fromEntries(new URLSearchParams(keyword));
        $.params = { ...params };
        $.searchList();
    });

    $(document).on("click", "#create-btn", function () {
        window.open($("#create_url").val(), "_self");
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
