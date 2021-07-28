<!DOCTYPE html>
<html lang="vi">
<meta http-equiv="content-type" content="text/html;charset=utf-8') }}" />
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#FFFFFF"/>
    {!! SEO::generate() !!}
    <link href="{{ $config->getWebLogo() }}" rel="icon"/>
    <!-- ================= Style ================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/base-colorc788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/bootstrap.minc788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/font-awesome.minc788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/owl.carousel.minc788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/basec788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/modulec788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/responsivec788.css?t=' . time()) }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/stylesheetc788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/stylec788.css?t=' . time()) }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/main/stylesheet/elipsport_stylec788.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/theme/default/stylesheet/checkout.css') }}"/>

</head>
<body class="common-home">
    <div class="hidden-md hidden-lg opacity_menu"></div>
    <div class="opacity_filter"></div>
    @include('web::components.menu_mobile')
    @include('web::components.header')
    @yield('content')
    @include('web::components.footer')

    <div id="buy_now_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông báo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn đã thêm 1 sản phẩm vào <a href="{{ route('cart.index') }}">giỏ hàng</a>!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </div>
        </div>
    </div>
    @include('web::components.facebook_chat')
</body>
<script type="text/javascript" 
    src="{{ asset('web/theme/main/javascript/jquery-3.3.1.minc788.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('web/theme/main/javascript/bootstrap.minc788.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('web/theme/main/javascript/owl.carousel.minc788.js') }}"></script>
<script type="text/javascript" 
    src="{{ asset('web/theme/main/javascript/mainc788.js') }}"></script>
<script type="text/javascript" 
    src="{{ asset('web/theme/cart.js?t=' . time()) }}"></script>
<script type="text/javascript" 
    src="{{ asset('web/theme/custom.js?t=' . time()) }}"></script>
@yield('scripts')
<script
	src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9"></script>
<script>jQuery(document).ready(function($){function detectmob(){if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i) ){return true;}else{return false;}}var t={delay: 125, overlay: $(".fb-overlay"), widget: $(".fb-widget"), button: $(".fb-button")}; setTimeout(function(){$("div.fb-livechat").fadeIn()}, 8 * t.delay); if(!detectmob()){$(".ctrlq").on("click", function(e){e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({bottom: 0, opacity: 0}, 2 * t.delay, function(){$(this).hide("slow"), t.button.show()})) : t.button.fadeOut("medium", function(){t.widget.stop().show().animate({bottom: "30px", opacity: 1}, 2 * t.delay), t.overlay.fadeIn(t.delay)})})}});</script>
</html>
