$(function () {
    $.extend({
        getOtherProducts: function(params) {
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

var ww = $(window).width();
$(document).ready(function () {

    let params = {
        action: "other-products",
        category_id: $("#category_id").val(),
    };

    $.getOtherProducts(params);

    $(document).on("click", "#load_more", function () {
        $(this).remove();
        $(".loader").show();
        params.page = Number($(this).attr("data-next-page"));
        $.getOtherProducts(params);
    });

    $("#gallery_02 a").on("click", function (e) {
        e.preventDefault();
    });

    if (ww > 991) {
        $("#img_01").elevateZoom({
            gallery: "gallery_02",
            zoomWindowWidth: 300,
            zoomWindowHeight: 300,
            zoomWindowOffetx: 0,
            easing: true,
            scrollZoom: true,
            cursor: "pointer",
            galleryActiveClass: "active",
            imageCrossfade: true,
            loadingIcon: "http://www.elevateweb.co.uk/spinner.gif",
        });
    } else {
        $("#gallery_02 a").on("click", function (e) {
            var image = $(this).attr("href");
            $(".large_image_url.checkurl")
                .attr("href", image)
                .find("#img_01")
                .attr("src", image)
                .attr("data-zoom-image", image);
        });
    }
});