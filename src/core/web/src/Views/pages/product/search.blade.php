@extends('web::layouts.main')
@section('content')
<section class="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="https://spatina.exdomain.net/">
                            <span><i class="fa fa-home"></i> {{ trans('web::label.home') }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    <li><strong>Tìm kiếm</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="product-search">
    <div class="signup search-main">
        <div class="container">
            <div class="row">
                <div id="content" class="main_container collection margin-bottom-30 col-sm-12 col-xs-12 col-md-12">
                    <div class="product-search-custom">
                        <h2><a href="javascript:void(0)" class="title-box">Tìm kiếm - <span id="keyword-string"></span></a></h2>
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="text" name="search" value="" placeholder="Từ khóa" id="input-search" class="form-control">
                            </div>
                            <div class="col-sm-2"><input type="button" value="Tìm kiếm" id="button-search" class="btn btn-primary"></div>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Các sản phẩm thỏa mãn tiêu chí tìm kiếm</h4>
            <section class="products-view products-view-grid collection_reponsive">
                <div id="product_list" class="row">
                    
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('web/theme/product.js?t=' . time()) }}"></script>
@endsection