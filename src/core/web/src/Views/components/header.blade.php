<header class="header " id="navbar">
        <div class="mid-header">
            <div class="container">
                <div class="row">
                    <div class="content_header">
                        <div class="header-main">
                            <div class="menu-bar-h nav-mobile-button hidden-md hidden-lg">
                                <a href="#nav-mobile">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="index.html" class="logo-wrapper ">
                                        <img src="{{ $config->getWebLogo() }}" alt="$config->company_name">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="header-left">
                                    <div class="header_search header_searchs hidden-xs hidden-sm">
                                        <form method="get" action="{{ route('product.search') }}" class="input-group search-bar">
                                            <input type="search" name="keyword" value="" placeholder="Tìm kiếm"
                                                class="input-group-field st-default-search-input search-text"
                                                autocomplete="off">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn icon-fallback-text">
                                                    <span class="fa fa-search"></span>
                                                </button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="header-right">
                                    <div class="header-acount hidden-lg-down">
                                        <div class="wishlist_header hidden-xs hidden-sm">
                                            <div class="img_hotline">
                                                <i class="fa fa-phone"></i>
                                                <a class="hai01" href="tel:{{ $config->phone1 }}">{{ $config->phone1 }}</a>
                                            </div>
                                        </div>
                                        <div id="cart">
                                            <div
                                                class="top-cart-contain f-right hidden-xs hidden-sm visible-md visible-lg">
                                                <div class="mini-cart text-xs-center">
                                                    <div class="heading-cart">
                                                        <i class="fa fa-shopping-cart" style="font-size: 26px; margin-right: 15px; color: #EB5858" aria-hidden="true"></i>
                                                        <a class="bg_cart" href="checkout/cart.html" title="Giỏ hàng">
                                                            <span class="count_item count_item_pr cart-total">(0)</span>
                                                        </a>
                                                    </div>
                                                    <div class="top-cart-content">
                                                        <ul id="cart-sidebar" class="mini-products-list count_li">
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="top-cart-contain f-right hidden-lg hidden-md visible-xs visible-sm">
                                                <div class="mini-cart text-xs-center">
                                                    <div class="heading-cart-mobi">
                                                        <a class="bg_cart" href="checkout/cart.html" title="Giỏ hàng">
                                                            <img alt="Giỏ hàng"
                                                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                                                                data-src="{{ asset('web/image/icon_cart_mobi.png') }}"
                                                                class="lazy" />
                                                            <span class="count_item count_item_pr cart-total">0</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-menu">
            <div class="container">

                <nav class="navbar navbar-expand-lg main-menu d-none d-xl-block">
                    <div class="collapse show">
                        <ul class="navbar-nav mr-auto">
                            @if(isset($categories))
                            <li class="menu-item category-item">
                                <a href="index.html" target="_self"><i class="fa fa-bars mr-1" aria-hidden="true"></i>Danh mục sản phẩm</a>
                            </li>
                            @endif
                            <li class="menu-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"><a href="/" target="_self">{{ trans('web::label.home') }}</a></li>
                            
                            <li class="menu-item {{ Route::currentRouteName() == 'page.about' ? 'active' : '' }}"><a href="{{ route('page.about') }}" target="_self">{{ trans('web::label.about') }}</a></li>
                            <li class="menu-item {{ strpos(Route::currentRouteName(), 'product.') !== false ? 'active' : '' }}"><a href="{{ route('product.index') }}" target="_self">{{ trans('web::label.product') }}</a></li>
                            <li class="menu-item {{ strpos(Route::currentRouteName(), 'post.') !== false ? 'active' : '' }}"><a href="{{ route('post.index') }}" target="_self">{{ trans('web::label.news') }}</a></li>
                            <li class="menu-item {{ Route::currentRouteName() == 'page.contact' ? 'active' : '' }}"><a href="{{ route('contact.index') }}" target="_self">{{ trans('web::label.contact') }}</a></li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>