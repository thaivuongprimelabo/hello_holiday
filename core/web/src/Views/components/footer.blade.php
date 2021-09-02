<section class="awe-section-10 " id="service-4">
    <div class="footer-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="tel:0123456789 ">
                        <div class="hotline">
                            <i class="fa fa-headphones" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">{{ trans('web::label.product_advise') }}</span>
                                <span class="bottom">{{ $config->phone1 }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="tel:0123456789 ">
                        <div class="hotline">
                            <i class="fa fa-cogs" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">{{ trans('web::label.technical_support') }}</span>
                                <span class="bottom">{{ $config->phone2 }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="javascript:void(0)">
                        <div class="hotline">
                            <i class="fa fa-truck" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">{{ trans('web::label.delivery_warranty') }}</span>
                                <span class="bottom">24H thần tốc</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="javascript:void(0)">
                        <div class="hotline">
                            <i class="fa fa-shield" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">{{ trans('web::label.best_year') }}</span>
                                <span class="bottom">Thương hiệu số 1</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="footer-template">
    <div class="container">
        <div id="footer" class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 footer-block support">
                <h4 data-toggle="collapse" href="#support-links-0" aria-expanded="true"
                    aria-controls="collapseExample"> {{ $config->web_title }} hỗ trợ KH</h4>
                <div class="collapse dont-collapse-sm" aria-expanded="false" id="support-links-0">
                    <ul class="row small-gutter">
                    </ul>
                    <ul class="">
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="tel:{{ $config->phone3 }}">{{ trans('web::label.buying_call') }}</a>
                        </li>
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="tel:{{ $config->phone4 }}">{{ trans('web::label.advise_call') }}</a>
                        </li>
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="tel:{{ $config->phone5 }}">{{ trans('web::label.warranty_call') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 footer-block support">
                <h4 data-toggle="collapse" href="#support-links-1" aria-expanded="true"
                    aria-controls="collapseExample"> Chính sách {{ $config->web_title }}</h4>
                <div class="collapse dont-collapse-sm" aria-expanded="false" id="support-links-1">
                    <ul class="row small-gutter">
                    </ul>
                    <ul class="">
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="{{ route('page.shopping') }}">{{ trans('web::label.shopping_guide') }}</a>
                        </li>
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="{{ route('page.warranty') }}">{{ trans('web::label.warranty_policy') }}</a>
                        </li>
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="{{ route('page.delivery') }}">{{ trans('web::label.delivery_policy') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 footer-block support">
                <h4 data-toggle="collapse" href="#support-links-2" aria-expanded="true"
                    aria-controls="collapseExample"> Về {{ $config->web_title }}</h4>
                <div class="collapse dont-collapse-sm" aria-expanded="false" id="support-links-2">
                    <ul class="row small-gutter">
                    </ul>
                    <ul class="">
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="{{ route('page.about') }}">Giới thiệu</a>
                        </li>
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="{{ route('contact.index') }}">Liên hệ</a>
                        </li>
                        <li class="menu-item lv-0">
                            <a rel="nofollow" class="nav-link" href="{{ route('post.index') }}">Tin tức</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 footer-block support">
                <h4 data-toggle="collapse" href="#support-links-3" aria-expanded="true"
                    aria-controls="collapseExample">Mạng xã hội</h4>
                <div class="collapse dont-collapse-sm" aria-expanded="false" id="support-links-3">
                    <ul class="row small-gutter">
                        <li class="menu-item lv-0">
                            <a href="{{ $config->youtube_channel }}" target="_blank" title="{{ $config->youtube_channel }}">
                                Youtube
                            </a>
                        </li>
                        <li class="menu-item lv-0">
                            <a href="{{ $config->shopee_fanpage }}" target="_blank" title="{{ $config->shopee_fanpage }}">
                                Shopee
                            </a>
                        </li>
                        <li class="menu-item lv-0">
                            <a href="{{ $config->zalo_fanpage }}" target="_blank" title="{{ $config->zalo_fanpage }}">
                                Zalo
                            </a>
                        </li>
                    </ul>
                    <ul class="">
                    </ul>
                </div>
            </div>
            <div class="clear"></div>

        </div>
    </div>
</div>

<footer class="footer">
    <div class="site-footer" <div class="top-footer mid-footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <div class="widget-ft">
                        <h4 class="title-menu">
                            <a role="button" class="" data-toggle="collapse" aria-expanded="true"
                                data-target="#collapseListMenu01" aria-controls="collapseListMenu01">
                                {{ $config->web_title }} <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </h4>
                        <div class="collapse in" id="collapseListMenu01">
                            <div class="list-menu">
                                <div class="widget-ft wg-logo">
                                    <div class="item">
                                        {!! $config->footer !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                    <div class="widget-ft last-child">
                        <div class="title-menu title-db">
                            <a role="button" class="" data-toggle="collapse" aria-expanded="true"
                                data-target="#collapseListMenu03" aria-controls="collapseListMenu03">
                                Facebook
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="collapse in" id="collapseListMenu03">
                            <div class="facebook">
                                <div class="fb-page" data-href="{{ $config->facebook_fanpage }}"
                                    data-small-header="false" data-adapt-container-width="false"
                                    data-hide-cover="false" data-show-facepile="false"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright clearfix">
        <div class="container">
            <div class="inner clearfix">
                <div class="row tablet">
                    <div id="copyright" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 a-center fot_copyright">
                        <span class="wsp">&copy; Copyright {{ date('Y') }} {{ $config->web_title }}. </span>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" id="back-to-top" class="backtop" title="Lên đầu trang">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                    class="icon_back_top">
                    <path
                        d="M10.667 14.667h4v13.333h2.667v-13.333h4l-5.333-5.333-5.333 5.333zM5.333 4v2.667h21.333v-2.667h-21.333z">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</footer>