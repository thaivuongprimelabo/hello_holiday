@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('auth.order.list') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i>
                            Quay lại
                        </a>
                    </h3>
                    <div class="card-tools">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i>
                            Lưu
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên khách hàng', 
                                'name' => 'customer_name', 
                                'item' => $order
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Địa chỉ', 
                                'name' => 'customer_address', 
                                'item' => $order
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Tỉnh/thành', 
                                'name' => 'customer_province', 
                                'item' => $order,
                                'options' => $cities
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Quận/huyện', 
                                'name' => 'customer_district', 
                                'item' => $order,
                                'options' => $districts
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Phường/xã', 
                                'name' => 'customer_block', 
                                'item' => $order,
                                'options' => $blocks
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Số ĐT', 
                                'name' => 'customer_phone', 
                                'item' => $order
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Email', 
                                'name' => 'customer_email', 
                                'item' => $order,
                            ])

                            @include('cms::auth.components.form.textarea', [
                                'label' => 'Note', 
                                'name' => 'customer_note', 
                                'item' => $order,
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Phương thức thanh toán', 
                                'name' => 'payment_method', 
                                'item' => $order,
                                'options' => json_decode(json_encode(\Cms\Constants::$paymentMethodList), FALSE)
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Trạng thái', 
                                'name' => 'status', 
                                'item' => $order,
                                'options' => json_decode(json_encode(\Cms\Constants::$orderStatusList), FALSE)
                            ])


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chi tiết đơn hàng</label>
                                <table class="table table-bordered">
                                    <colgroup> 
                                        <col span="1" style="width: 15%;">
                                        <col span="1" style="width: 20%;">
                                        <col span="1" style="width: 5%;">
                                    </colgroup>
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
                                            <td>{{ $order->getSubtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right"><b>Thành tiền (vnđ)</b></td>
                                            <td>{{ $order->getTotal() }}</td>
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