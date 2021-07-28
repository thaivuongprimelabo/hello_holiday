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
                <li class="level0 level-top parent level_ico category-menu-mobile">
                    <a href="javascript:void(0)">
                        Danh mục sản phẩm
                    </a>
                    <i class="fa fa-arrow-circle-right open-child-level1" style="color: #ffffff; display:block; line-height: 35px" aria-hidden="true"></i>
                    <ul class="level1 level-top level_ico hidden">
                        @foreach($categories as $category)
                        @php
                            $count = $category->childCategories->count();
                        @endphp
                        <li  style="border-bottom: 1px solid #ffffff">
                            <a href="{{ $category->getLink() }}">
                                {{ $category->getName() }}
                            </a>
                            @if($count)
                            <i class="fa fa-arrow-circle-right open-child-level2" style="color: #ffffff" aria-hidden="true"></i>
                            @endif
                            @if($count)
                            <ul class="level2 level-top level_ico hidden">
                                @foreach($category->childCategories as $childCategory)
                                <li style="border-bottom: 1px solid #ffffff">
                                    <a href="{{ $childCategory->getLink() }}">
                                        {{ $childCategory->getName() }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
                
            </ul>

            <ul class="ct-mobile">
                
            </ul>
        </div>
    </div>
</div>
<!-- End -->