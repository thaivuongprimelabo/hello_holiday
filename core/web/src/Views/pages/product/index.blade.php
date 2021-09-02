@extends('web::layouts.main')
@section('content')
<section class="awe-section-1" id="awe-section-1">
    <div class="section_category_slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-3 sidebar col-left clearfix no-padding-right">
                    <div id="column-left" class="left-column compliance">
                        @include('web::components.category')
                        <div class="clearfix"></div>
                        @include('web::components.price_filter')
                    </div>
                </div>
                
                <div class="col-sm-12 col-xs-12 col-md-9 no-padding-left" style="z-index: 0">
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
                                        <li><strong>Sản phẩm</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <section id="product_list">
                            
                        </section>
                        <div class="loader"></div>
                    </section>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('web/theme/product.js?t=' . time()) }}"></script>
@endsection