@extends('web::layouts.main')
@section('content')
<section class="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="/">
                            <span><i class="fa fa-home"></i> {{ trans('web::label.home') }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    <li><strong>{{ $post->getName() }}</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="news-news">
    <div class="container article-wraper">
        <div class="row">
            <div id="content" class="right-content col-sm-12 col-xs-12 col-md-12">
                <div class="box-heading relative"></div>
                <article class="article-main">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="article-details">
                                <h1 class="article-title">{{ $post->getName() }}</h1>
                                <div class="date">
                                    <i class="fa fa-clock-o"></i>
                                    <div class="news_home_content_short_time">{{ $post->getCreatedAt() }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                    @foreach($post->getTags() as $tag)
                                    <a class="tag" href="{{ $tag->getLink() }}" title="{{ $tag->getName() }}"><i class="fa fa-tag"></i>&nbsp;{{ $tag->getName() }}</a>
                                    @endforeach
                                    </div>
                                </div>
                                <div class="article-content">
                                    {!! $post->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection