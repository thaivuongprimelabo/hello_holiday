<!-- Menu mobile -->
<div id="mySidenav" class="sidenav menu_mobile hidden-md hidden-lg">
    <div class="top_menu_mobile">
        <span class="close_menu"><img src="{{ $config->getWebLogo() }}" alt="{{ $config->web_title }}"></span>
    </div>
    <div class="content_memu_mb">
        <div class="link_list_mobile">
            <ul class="ct-mobile hidden"></ul>
            <ul class="ct-mobile">
                <li class="level0 level-top parent level_ico">
                    <a href="/">{{ trans('web::label.home') }}</a>
                </li>
                <li class="level0 level-top parent level_ico">
                    <a href="{{ route('page.about') }}">{{ trans('web::label.about') }}</a>
                </li>
                <li class="level0 level-top parent level_ico">
                    <a href="{{ route('product.index') }}">{{ trans('web::label.product') }}</a>
                </li>
                <li class="level0 level-top parent level_ico">
                    <a href="{{ route('post.index') }}">{{ trans('web::label.news') }}</a>
                </li>
                <li class="level0 level-top parent level_ico">
                    <a href="{{ route('contact.index') }}">{{ trans('web::label.contact') }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End -->