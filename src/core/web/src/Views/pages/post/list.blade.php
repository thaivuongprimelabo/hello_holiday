@foreach($posts as $post)
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <article class="blog-item">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="blog_items">
                    <div class="myblog"
                        onclick="window.location.href='{{ $post->getLink() }}';">
                        <div class="image-blog-left">
                            <a href="{{ $post->getLink() }}">
                                <picture>
                                    <img src="{{ $post->getPhoto() }}"
                                        title="{{ $post->getName() }}">
                                </picture>
                            </a>
                        </div>
                        <div class="content-right-blog">
                            <div class="title_blog_home">
                                <h4><a href="{{ $post->getLink() }}"
                                        title="{{ $post->getName() }}">{{ $post->getName() }}</a></h4>
                            </div>
                            <div class="content_day_blog">
                                <span class="fix_left_blog">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="news_home_content_short_time">{{ $post->getCreatedAt() }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
@endforeach
@if($posts->hasMorePages())
<div id="load_more" class="col-sm-12 col-xs-12 col-md-12 text-center" style="padding: 10px 0px" data-next-page="{{ $posts->currentPage() + 1 }}">
    <button class="btn btn-primary">Xem các tin tức khác</button>
</div>
@endif