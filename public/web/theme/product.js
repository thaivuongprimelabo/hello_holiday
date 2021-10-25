$(function () {
    $.extend({
        getProducts: function(params) {
            $.post({
                url: "/get-products",
                data: params,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
            .then(function (response) {
                $("#product_list").append(response);
                $(".loader").hide();
            })
            .catch(function (e) {
                console.log(e);
            });
        },
    });
});

$(document).ready(function() {
    let params = {
        page: 1,
        action: 'products'
    }

    let url = window.location.pathname.split('/');
    if (window.location.pathname.indexOf("category") >= 0) {
        params.action = "category";
        params.slug = url[2] !== undefined ? url[2].replace('.html', '') : "";
        params.child_slug = url[3] !== undefined ? url[3].replace(".html", "") : "";
    }

    if (window.location.pathname.indexOf("tag") >= 0) {
        params.action = "tag";
        params.slug = url[3] !== undefined ? url[3].replace('.html', '') : "";
    }

    if (window.location.pathname.indexOf("search") < 0) {
        $.getProducts(params);
    }

    if (window.location.pathname.indexOf("search") >= 0 && window.location.search) {
        const query = new URLSearchParams(window.location.search);
        params.keyword = query.get("keyword");
        $('#input-search').val(query.get("keyword"));
        $("#keyword-string").html(query.get("keyword"));
        $.getProducts(params);
    }
    

    $(document).on('click', "#load_more", function() {
        $(this).remove();
        $(".loader").show();
        params.page = Number($(this).attr('data-next-page'));
        $.getProducts(params);
    });

    $('input[name="price"]').click(function() {
        $("#product_list").html("");
        $(".loader").show();
        params.price = $(this).val();
        $.getProducts(params);
    });

    $("#button-search").click(function() {
        $("#product_list").html("");
        $(".loader").show();
        let keyword = $('#input-search').val();
        params.keyword = keyword;
        $.getProducts(params);
    });
})