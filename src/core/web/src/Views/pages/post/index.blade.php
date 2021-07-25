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
                        <li><strong>Tin tức</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <section id="content" class="right-content margin-bottom-50 col-sm-12 col-xs-12 col-md-12">
                <section class="list-blogs blog-main">
                    <div id="post_list" class="row">
                        
                    </div>
                </section>
            </section>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('web/theme/post.js?t=' . time()) }}"></script>
@endsection