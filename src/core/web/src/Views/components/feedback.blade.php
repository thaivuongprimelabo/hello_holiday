<div class="content_mainbottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if($posts->count())
                <section class="awe-section-9 " id="news_custom-0">
                    <section class="recent_news pt-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="news">
                                        <h2 class="title-line mb-0">TIN MỚI NHẤT</h2>
                                        <div class="row">
                                            @foreach($posts as $post)
                                            <div class="col-12 col-sm-3">
                                                <article class="featured">
                                                    <div class="thumb">
                                                        <a
                                                            href="{{ $post->getLink() }}">
                                                            <img src="{{ $post->getPhoto() }}" alt="{{ $post->name }}">
                                                        </a>
                                                    </div>
                                                    <h3>
                                                        <a href="{{ $post->getLink() }}" title="{{ $post->name }}">{{ $post->name }}</a>
                                                    </h3>
                                                    <p class="excerpt">{!! $post->getDescription() !!}</p>
                                                </article>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
                @endif
            </div>
        </div>
    </div>
</div>
