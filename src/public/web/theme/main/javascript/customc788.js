/*=========================================*/
/*Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position*/
function sticky_menu(menu, sticky) {
    if (typeof menu === 'undefined' || !jQuery.isNumeric(sticky) ) sticky = 0;
    if ($(window).scrollTop() >= sticky) {
        if ($('#just-for-height').length === 0) {
            menu.after('<div id="just-for-height" style="height:' + menu.height() + 'px"></div>')
        }
        menu.addClass("sticky");
    } else {
        menu.removeClass("sticky");
        $('#just-for-height').remove();
    }
}
$(document).ready(function(){
    var menu = $("#navbar");
    if (menu.length) {
        var sticky = menu.offset().top + 1;
        if ($(window).width() > 767) {
            sticky_menu(menu, sticky);
            $(window).on('scroll', function () {
                sticky_menu(menu, sticky);
            });
        }
    }
})

$(document).ready(function () {
    /*Get the navbar*/
    var menu = $("body > header");
    /*Get the offset position of the navbar*/
    var sticky = menu.offset().top + 1;
    /*When the user scrolls the page, execute myFunction*/
    if ($(window).width() > 767) {
        /*sticky_menu(menu, sticky);*/
        $(window).on('scroll', function () {
            /*sticky_menu(menu, sticky);*/
        });
    }
});
/*=========================================*/
/* check current page in menu header */
var curren_page = $('#mp_header .main-nav a[href="' + window.location.href + '"]');
curren_page.parent().addClass('active');
curren_page.closest('.main-nav > li').addClass('active');
/* check current page in category */
$('.aside-item.sidebar-category li.lv2.active').closest('li.lv1').addClass('active');
$('.aside-item.sidebar-category li.lv2 a[href="'+window.location.href+'"]').parent().addClass('active').closest('li.lv1').addClass('active');
$(document).ready(function () {
    /* fix pagination */
    /*$('.pagination').addClass('clearfix');
    $('.pagination > li').addClass('page-item');
    $('.pagination > li > *').addClass('page-link');*/
});
/*=========================================*/
var desktop_currency = $('#mp_header .top-header .container .right .currency');
var desktop_search = $('#mp_header .top-header .container .right .searchbox');
var desktop_cart = $('#mp_header .bottom-header .mini-cart #cart');
if ($(window).width() < 992) {
}
$(window).resize(function () {
    if ($(window).width() < 992) {
    } else {
    }
});
$(window).scroll(function () {
});
