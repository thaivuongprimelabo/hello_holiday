<aside class="aside-item sidebar-category collection-category">
    <div class="aside-title">
        <div class="title-head margin-top-0"><span>Tags</span></div>
    </div>
    <div class="aside-content">
        <ul class="nav navbar-pills" style="background-color: #ffffff;">
            <li style="padding: 10px">
                @foreach($tags as $tag)
                <a class="tag" href="{{ isset($product) ? $tag->getProductLink() : $tag->getPostLink() }}"><i class="fa fa-tag"></i>&nbsp;{{ $tag->getName() }}</a>
                @endforeach
            </li>
        </ul>
    </div>
</aside>
