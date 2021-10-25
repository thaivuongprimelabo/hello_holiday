$(function () {
    $.extend({
        getPosts: function (params) {
            $.post({
                url: "/get-posts",
                data: params,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
            .then(function (response) {
                $("#post_list").append(response);
                $(".loader").hide();
            })
            .catch(function (e) {
                console.log(e);
            });
        },
    });
});

$(document).ready(function() {
    $(".loader").show();

    let params = {
        page: 1,
        action: "",
    };

    let url = window.location.pathname.split("/");
    if (window.location.pathname.indexOf("tag") >= 0) {
        params.action = "tag";
        params.slug = url[3] !== undefined ? url[3].replace(".html", "") : "";
    }

    $.getPosts(params);

    $(document).on("click", "#load_more", function () {
        $(this).remove();
        $(".loader").show();
        params.page = Number($(this).attr("data-next-page"));
        $.getPosts(params);
    });
});

