@extends('web::layouts.main')
@section('content')
<div class="news-category">
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
                        <li class="home">
                            <a href="#">
                                <span>{{ trans('web::label.news') }}</span>
                            </a>
                            <span><i class="fa">/</i></span>
                        </li>
                        <li class="home">
                            <a href="#">
                                <span>Tag</span>
                            </a>
                            <span><i class="fa">/</i></span>
                        </li>
                        <li><strong>{{ $tag->getName() }}</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <section id="content" class="right-content margin-bottom-50 col-sm-12 col-xs-12 col-md-9 col-md-push-3">
                <section class="list-blogs blog-main">
                    <div id="post_list" class="row">
                        
                    </div>
                    <div class="loader"></div>
                </section>
            </section>
            <aside class="col-sm-12 col-xs-12 col-md-3 sidebar left left-content clearfix col-md-pull-9">
                <div id="column-left" class="left-column compliance">
                    @include('web::components.tag_list')
                    <div class="clearfix"></div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('web/theme/post.js?t=' . time()) }}"></script>
@endsection