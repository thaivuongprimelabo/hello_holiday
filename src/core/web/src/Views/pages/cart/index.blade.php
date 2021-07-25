@extends('web::layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <section class="bread-crumb">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="index.html">
                            <span><i class="fa fa-home"></i> {{ trans('web::label.home') }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    <li><strong>{{ trans('web::label.cart') }}</strong></li>
                </ul>
            </div>
        </section>
    </div>
</div>

<div class="checkout-cart">
    <div class="container">
        <div id="content" class="col-sm-12" style="padding: 20px" ;="">
            @if($cart->exists())
            <h3>{{ trans('web::label.cart') }}</h3>
            <form action="https://spatina.exdomain.net/checkout/cart/edit" method="post" enctype="multipart/form-data">
                <div class="table-responsive table-cart-content v-base-content">
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <td class="text-center"><strong>Ảnh</strong></td>
                            <td class="text-center"><strong>Sản phẩm</strong></td>
                            <td class="text-center"><strong>Đơn giá</strong></td>
                            <td class="text-center"><strong>Số lượng</strong></td>
                            <td class="text-center"><strong>Tổng</strong></td>
                            <td class="text-center"><strong>Xóa</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->getCart() as $cartItem)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $cartItem->getImage() }}">
                                </td>
                                <td class="text-left">
                                    <a href="https://spatina.exdomain.net/xe-dap-tap-the-thao-mk-429">{{ $cartItem->getName() }}</a>
                                </td>
                                <td class="text-right">
                                    {{ $cartItem->getPriceFormat() }}
                                </td>
                                <td class="text-left input_qty_pr">
                                    <div class="input_qty_pr input-group">
                                        <span class="input-group-btn"><button class="reduced_pop items-count btn-minus btn" type="button">–</button></span>
                                        <input type="text" maxlength="4" min="0" class="input-text number-sidebar input_pop form-control input-qty" data-id="{{ $cartItem->getId() }}" size="4" value="{{ $cartItem->getQty() }}">
                                        <span class="input-group-btn"><button class="increase_pop items-count btn-plus btn" type="button">+</button></span>
                                    </div>
                                </td>
                                <td class="text-right">
                                    {{ $cartItem->getCostFormat() }}
                                </td>
                                <td class="text-center">
                                    <button type="button" data-id="{{ $cartItem->getId() }}" class="btn btn-danger remove-item-cart"><i class="fa fa-times-circle"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-xs-4">
                        <button type="button" class="btn btn-primary destroy-cart">{{ trans('web::label.button.cart_destroy') }}</button>
                    </div>
                    <div class="col-sm-8 col-xs-8">
                        <button type="button" class="btn btn-primary update-cart pull-right">{{ trans('web::label.button.update_cart') }}</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                                    </div>
                <div class="col-sm-4 col-sm-offset-8">
                    <table class="table table-bordered">
                                                <tbody><tr>
                            <td class="text-right">Thành tiền:</td>
                            <td class="text-right"><strong>{{ $cart->getSubTotalFormat() }}</strong></td>
                        </tr>
                                                <tr>
                            <td class="text-right">Tổng số:</td>
                            <td class="text-right"><strong>{{ $cart->getTotalFormat() }}</strong></td>
                        </tr>
                                            </tbody></table>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6 col_button_shopping">
                            <a href="/" class="btn btn-default pull-left button_shopping">{{ trans('web::label.button.continue_shopping') }}</a>
                        </div>
                        <div class="col-sm-6 col-xs-6 col_button_checkout">
                            <a href="{{ route('cart.checkout') }}" class="btn btn-primary pull-right button_checkout">{{ trans('web::label.button.checkout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p>Bạn chưa mua sản phẩm nào!</p>   
            @endif
        </div>
    </div>
</div>
@endsection