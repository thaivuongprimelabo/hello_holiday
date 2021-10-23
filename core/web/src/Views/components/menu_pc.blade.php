<div class="bottom-menu">
    <div class="container">
        <nav class="navbar navbar-expand-lg main-menu d-none d-xl-block">
            <div class="collapse show">
                <ul class="navbar-nav mr-auto">
                    @if(isset($categories))
                    <li class="menu-item category-item">
                        <a href="javascript:void(0)" target="_self"><i class="fa fa-bars mr-1" aria-hidden="true"></i>Danh mục sản phẩm</a>
                    </li>
                    @endif
                    @if($menuList)
                    @foreach($menuList as $menu)
                    <li class="menu-item {{ url()->current() == $menu->getUrl() ? 'active' : '' }}"><a href="{{ $menu->getUrl() }}" target="{{ $menu->target }}">{{ $menu->getName() }}</a>
                        @if($menu->childMenus)
                        <ul class="menu-sub-item">
                            @foreach($menu->childMenus as $childMenu)
                            <li><a href="{{ $childMenu->getUrl() }}" target="{{ $childMenu->target }}">{{ $childMenu->getName() }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>