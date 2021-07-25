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
            })
            .catch(function (e) {
                console.log(e);
            });
        },
    });
});

$(document).ready(function() {
    $.getPosts(1);
});

$(document).on("click", "#load_more", function () {
    $(this).remove();
    $.getPosts(Number($(this).attr("data-next-page")));
});