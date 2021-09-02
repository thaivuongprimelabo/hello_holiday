$(function () {
    $.extend({
        getPosts: function (page) {
            $.get({
                url: "/get-posts?page=" + page,
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
    $.getPosts(1);
});

$(document).on("click", "#load_more", function () {
    $(this).remove();
    $(".loader").show();
    $.getPosts(Number($(this).attr("data-next-page")));
});