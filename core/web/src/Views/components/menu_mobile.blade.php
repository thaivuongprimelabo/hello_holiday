<!-- Menu mobile -->
<div id="mySidenav" class="sidenav menu_mobile hidden-md hidden-lg">
    <div class="top_menu_mobile">
        <span class="close_menu"><img src="{{ $config->getWebLogo() }}" alt="{{ $config->web_title }}" style="height:70px;
"></span>
    </div>
    <div class="content_memu_mb">
        <div class="link_list_mobile">
            <ul class="ct-mobile hidden"></ul>
            <ul class="ct-mobile">
                @if($menuList)
                    @foreach($menuList as $menu)
                    <li class="level0 level-top parent level_ico">
                        <a href="{{ $menu->getUrl() }}" class="category-mobile-1" target="{{ $menu->target }}">{{ $menu->getName() }}</a>
                        @if($menu->childMenus && count($menu->childMenus))
                        <i class="fa fa-arrow-circle-right open-child-level1" style="color: #ffffff; display:block; line-height: 35px" aria-hidden="true"></i>
                        <ul class="level1 level-top level_ico hidden">
                            @foreach($menu->childMenus as $childMenu)
                            <li style="border-bottom: 1px solid #ffffff; padding-left: 20px"><a href="{{ $childMenu->getUrl() }}" target="{{ $childMenu->target }}">{{ $childMenu->getName() }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    
                    @endforeach
                @endif
                @if(isset($categories))
                <li class="level0 level-top parent level_ico category-menu-mobile">
                    <a href="javascript:void(0)" class="category-mobile-1">
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
                            <i class="fa fa-arrow-circle-right open-child-level2" style="color: #ffffff; display:block; line-height: 20px" data-id="{{ $category->id }}" aria-hidden="true"></i>
                        </li>
                        @if($count)
                            @foreach($category->childCategories as $childCategory)
                            <li style="border-bottom: 1px solid #ffffff; padding-left: 20px" class="hidden level-2-{{ $category->id }}">
                                <a href="{{ $childCategory->getLink() }}">
                                    {{ $childCategory->getName() }}
                                </a>
                            </li>
                            @endforeach
                        @endif
                        @endforeach
                    </ul>
                </li>
                @endif

            </ul>

            <ul class="ct-mobile">

            </ul>
        </div>
    </div>
</div>
<!-- End -->
