@if($categories->count())
<aside class="aside-item sidebar-category collection-category  header" id="product_category-1">
    <div class="bottom-menu-category">
        <div class="append-data-menu" id="menu-category">
            <div class="vertical-menu d-xl-block">
                <ul>
                    @foreach($categories as $category)
                    @php
                        $count = $category->childCategories->count();
                    @endphp
                    <li class="has-sub">
                        <a class="{{ $count ? 'sub-menu-a' : '' }}" href="{{ $category->getLink() }}">
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            {{ $category->getName() }}
                        </a>
                        @if($count)
                        <div class="submenu">
                            <ul>
                                @foreach($category->childCategories as $childCategory)
                                <li>
                                    <a href="{{ $childCategory->getLink() }}">
                                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                        {{ $childCategory->getName() }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</aside>
@endif