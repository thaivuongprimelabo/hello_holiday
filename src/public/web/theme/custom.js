$(document).ready(function() {
    $(".open-child-level1").click(function () {
        let level1 = $(this).parent().find(".level1");
        if (level1.hasClass("hidden")) {
            level1.removeClass("hidden");
        } else {
            level1.addClass("hidden");
        }
    });

    $(".open-child-level2").click(function () {
        let level2 = $(this).parent().find(".level2");
        if (level2.hasClass("hidden")) {
            level2.removeClass("hidden");
        } else {
            level2.addClass("hidden");
        }
    });
})