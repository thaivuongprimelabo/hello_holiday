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
                    <li><strong>{{ trans('web::label.checkout') }}</strong></li>
                </ul>
            </div>
        </section>
    </div>
</div>
<div class="checkout-checkout">
    <div class="container">
        <div class="row">
            <div id="content" class="col-sm-12">
                <form id="checkout_form" method="post" action="{{ route('cart.checkout') }}" class="form-horizontal">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin thanh toán
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <!-- Apply for VN -->
                                    <div class="form-group required">
                                        <label class="control-label col-md-2" for="input-customer_name">Tên đầy đủ</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="customer_name" id="input-customer_name" value=""
                                                placeholder="Ví dụ: Nguyễn Văn A" class="form-control">
                                                <div class="text-danger">Vui lòng nhập</div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group required">
                                                <label class="control-label col-sm-4" for="input-customer_email">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="customer_email" id="input-customer_email" value=""
                                                        placeholder="contact@yourdomain.com" class="form-control">
                                                    <div class="text-danger">Vui lòng nhập</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group required">
                                                <label class="control-label col-sm-4" for="input-customer_phone">Điện
                                                    thoại</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="customer_phone" id="input-customer_phone" value=""
                                                        placeholder="Ví dụ: 01234567890" class="form-control">
                                                    <div class="text-danger">Vui lòng nhập</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label class="control-label col-md-6" for="input-zoneid"
                                                    id="label-zone">Tỉnh / TP</label>
                                                <div class="col-md-6">
                                                    <select class="form-control" name="customer_province">
                                                        <option value="">---</option>
                                                    </select>
                                                    <div class="text-danger">Vui lòng nhập</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label class="control-label col-md-6" for="input-address">Quận /
                                                    Huyện</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="customer_district">
                                                        <option value="">---</option>
                                                    </select>
                                                    <div class="text-danger">Vui lòng chọn</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label class="control-label col-md-6" for="input-address">Phường / Xã</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="customer_block">
                                                        <option value="">---</option>
                                                    </select>
                                                    <div class="text-danger">Vui lòng chọn</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="input-address">Địa chỉ</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="customer_address" value="" id="input-address"
                                                placeholder="Ví dụ: Số 247, Cầu Giấy, Q. Cầu Giấy"
                                                class="form-control">
                                            <div class="text-danger">Vui lòng nhập</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="input-zoneid" id="label-zone">Lời nhắn</label>
                                        <div class="col-sm-10">
                                            <textarea name="customer_note" id="input-comment" rows="3" class="form-control"
                                                placeholder="Ví dụ: Chuyển hàng ngoài giờ hành chính"></textarea>
                                        </div>
                                    </div>

                                    <hr>

                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-credit-card" aria-hidden="true"></i> Phương thức thanh toán
                                    </h3>
                                </div>
                                <div class="panel-body" id="form_payment_method">
                                    <div class="group">

                                        <div class="adr-oms radio select-method">
                                            <input type="radio" id="payment-method-cash" name="payment_method"
                                                value="cash" checked="">
                                            <label for="payment-method-cash">
                                                <div class="adr-oms payment-method">
                                                    <div class="thumbnail">
                                                        <img alt="Chuyển khoản"
                                                            src="{{ asset('web/theme/default/image/payment/cod.png') }}">
                                                    </div>
                                                    <div class="description">
                                                        <div class="title">Thanh toán khi nhận hàng</div>
                                                        <div class="subtitle">Khách hàng thanh toán bằng tiền mặt khi nhận hàng</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        <div class="adr-oms radio select-method">
                                            <input type="radio" id="payment-method-banking" name="payment_method"
                                                value="banking">
                                            <label for="payment-method-banking">
                                                <div class="adr-oms payment-method">
                                                    <div class="thumbnail">
                                                        <img alt="Chuyển khoản"
                                                            src="{{ asset('web/theme/default/image/payment/bank_transfer.png') }}">
                                                    </div>
                                                    <div class="description">
                                                        <div class="title">Chuyển khoản</div>
                                                        <div class="subtitle">Sử dụng thẻ ATM hoặc dịch vụ Internet
                                                            Banking để tiến hành chuyển
                                                            khoản cho chúng tôi</div>
                                                        <div class="tkz-selection-info" style="display: none;">
                                                            {!! $config->bank_info !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>

                                            <div class="payment-method-toggle box-installment installment-disabled"
                                                id="payment-method-info-bank_transfer" style="display: none;">
                                                <div class="disabled-cod-body">Mô tả thanh toán</div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        Đơn hàng ({{ $cart->getCount() }} sản phẩm)
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <table class="adr-oms table table_order_items">
                                        <tbody id="orderItem">
                                            @foreach($cart->getCart() as $cartItem)
                                            <tr class="group-type-1 item-child-0">
                                                <td>
                                                    <div class="table_order_items-cell-thumbnail">
                                                        <div class="thumbnail">
                                                            <a target="_blank" rel="noopener"
                                                                href="#"
                                                                title="{{ $cartItem->getName() }}">
                                                                <img src="{{ $cartItem->getImage() }}"
                                                                    alt="{{ $cartItem->getName() }}" width="84">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="table_order_items-cell-detail">
                                                        <div class="table_order_items-cell-title">
                                                            <div class="table_order_items_product_name">
                                                                <a target="_blank" rel="noopener"
                                                                    href="#"
                                                                    title="{{ $cartItem->getName() }}">
                                                                    <span class="title">{{ $cartItem->getName() }}</span></a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="table_order_items-cell-price">
                                                        <div class="tt-price">{{ $cartItem->getPriceFormat() }}</div>
                                                        <div class="quantity">x{{ $cartItem->getQty() }}</div>
                                                        <div class="tt-price">{{ $cartItem->getCostFormat() }}</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="panel panel-default" id="ajax-load-total">
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody class="orderSummary">
                                            <tr class="row-total-amount">
                                                <td class="text-left">Tạm tính</td>
                                                <td class="text-right">
                                                    <strong class="">{{ $cart->getSubTotalFormat() }}</strong>
                                                </td>
                                            </tr>
                                            <tr class="row-total-amount">
                                                <td class="text-left">Thành tiền</td>
                                                <td class="text-right">
                                                    <strong class="">{{ $cart->getTotalFormat() }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="pull-left" href="{{ route('cart.index') }}" title="Quay lại giỏ hàng">
                                    <i class="fa fa-mail-reply-all" aria-hidden="true"></i> {{ trans('web::label.button.back_to_cart') }}
                                </a>
                                <button class="btn btn-primary pull-right" type="button" id="submit_form_button">
                                    {{ trans('web::label.button.order') }} <i class="fa fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('web/theme/checkout.js?t=' . time()) }}"></script>
<script>
    $(document).ready(function() {
        $('input[name="payment_method"]').click(function() {
            $('.tkz-selection-info').hide();
            if ($(this).val() === 'banking') {
                $('.tkz-selection-info').show();
            }
        })
    });
</script>
@endsection