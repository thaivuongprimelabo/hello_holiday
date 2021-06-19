@extends('cms::auth.layouts.main')
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tìm kiếm sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-sm mb-2">
                    <input type="text" class="form-control" id="product_info_se" placeholder="Nhập thông tin sản phẩm">
                    <span class="input-group-append">
                        <button type="button" id="search_select_products" class="btn btn-primary btn-flat">Tìm kiếm</button>
                    </span>
                </div>
                
                    
                <table id="select_products_list" class="table table-bordered">
                    <thead>
                        <tr>
                            <td></td>
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Giá bán (vnđ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
              <button type="button" id="select_products_btn" class="btn btn-primary">Chọn</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>
@endsection