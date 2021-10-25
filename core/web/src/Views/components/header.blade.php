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
                                    <a href="/" class="logo-wrapper ">
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
                                                        <a class="bg_cart" href="{{ route('cart.index') }}" title="Giỏ hàng">
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
                                                        <a class="bg_cart" href="{{ route('cart.index') }}" title="Giỏ hàng">
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
        @include("web::components.menu_pc")
    </header>