@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        @include('cms::auth.components.form.button_back', [
                            'route' => 'auth.order.list'
                        ])
                    </h3>
                    <div class="card-tools">
                        @if($order->exists)
                        <a href="{{ route('auth.order.print', ['order' => $order->getKey()]) }}" target="_blank" class="btn btn-warning btn-sm">
                            <i class="fas fa-print"></i>
                            In hoá đơn
                        </a>
                        @endif
                        @include('cms::auth.components.form.button', [
                            'type' => 'submit',
                            'icon' => 'fas fa-save',
                            'label' => 'Lưu',
                        ])
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên khách hàng', 
                                'name' => 'customer_name', 
                                'item' => $order,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Địa chỉ', 
                                'name' => 'customer_address', 
                                'item' => $order,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Tỉnh/thành', 
                                'name' => 'customer_province', 
                                'item' => $order,
                                'options' => $cities,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Quận/huyện', 
                                'name' => 'customer_district', 
                                'item' => $order,
                                'options' => $districts,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Phường/xã', 
                                'name' => 'customer_block', 
                                'item' => $order,
                                'options' => $blocks,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Số ĐT', 
                                'name' => 'customer_phone', 
                                'item' => $order,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Email', 
                                'name' => 'customer_email', 
                                'item' => $order,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.textarea', [
                                'label' => 'Note', 
                                'name' => 'customer_note', 
                                'item' => $order,
                                'disabled' => $order->exists,
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Phương thức thanh toán', 
                                'name' => 'payment_method', 
                                'item' => $order,
                                'disabled' => $order->exists,
                                'options' => json_decode(json_encode(\Cms\Constants::$paymentMethodList), FALSE)
                            ])


                        </div>

                        <div class="col-md-6">
                            @include('cms::auth.components.form.select', [
                                'label' => 'Trạng thái', 
                                'name' => 'status', 
                                'item' => $order,
                                'options' => json_decode(json_encode(\Cms\Constants::$orderStatusList), FALSE)
                            ])
                            <div class="form-group">
                                <label>Chi tiết đơn hàng</label>
                                @if(!$order->exists)
                                <button type="button" id="select_products" class="btn btn-sm btn-primary mb-2" style="float:right">
                                    <i class="fas fa-plus"></i>
                                    Chọn sản phẩm
                                </button>
                                @endif
                                <table id="order_products" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mã SP</th>
                                            <th>Tên SP</th>
                                            <th>SL</th>
                                            <th>Giá bán (vnđ)</th>
                                            <th>Thành tiền (vnđ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $detail->product_id }}</td>
                                            <td>{{ $detail->name }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>{{ $detail->getPrice() }}</td>
                                            <td>{{ $detail->getCost() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" align="right"><b>Tạm tính (vnđ)</b></td>
                                            <td id="subtotal">{{ $order->getSubtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right"><b>Thành tiền (vnđ)</b></td>
                                            <td id="total">{{ $order->getTotal() }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('cms/modal.js') }}"></script>
<script>
    $(function () {
        $.initSelectProducts('#select_products');
    });
</script>
@endsection