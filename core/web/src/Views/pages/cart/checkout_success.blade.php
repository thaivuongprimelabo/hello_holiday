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
                    <li><strong>Thanh toán thành công</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="checkout-success">
    <section class="page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12">
                    <div class="page-title category-title">
                        <h1 class="title-head">
                            <span>Thanh toán đơn hàng thành công!</span>
                        </h1>
                    </div>
                    <div class="content-page rte">
                        <p>Giao dịch thành công!</p><p>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</p>                    <div class="buttons">
                            <div class="pull-right"><a href="/" class="btn btn-primary">Tiếp tục</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="content_mainbottom">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>
</div>
@endsection