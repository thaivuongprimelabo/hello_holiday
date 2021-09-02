Xin chào, {{ $order->customer_name }}<br/>
<br/>
Cảm ơn Anh/chị đã đặt hàng tại <b>{{ config('app.name') }}</b><br/>
<br/>
Đơn hàng của Anh/chị đã được tiếp nhận, chúng tôi sẽ nhanh chóng liên hệ với Anh/chị.<br/>
<hr/>
<b>Thông tin khách hàng</b><br/>
Tên KH: {{ $order->customer_name }}<br/>
Tel: {{ $order->customer_phone }}<br/>
E-mail: {{ $order->customer_email }}<br/>
Đ/c: {{ $order->customer_address }}, {{ $order->block->name }}, {{ $order->district->name }}, {{ $order->city->name }}<br/>
<br/>
<b>Hình thức thanh toán</b><br/>
{{ $order->payment_method == 'cash' ? 'Thanh toán bằng tiền mặt' : 'Chuyển khoản ngân hàng'}}
<br/><br/>
<b>Thông tin đơn hàng</b><br/>
Mã đơn hàng: #{{ $order->id }}<br/>
Ngày đặt hàng: {{ $order->created_at }}<br/>
<br/>
<table>
    <tbody>
    @foreach($order->orderDetails as $detail)
    	<tr >
    		<td style="padding:5px">{{ $detail->getName() }} x {{ $detail->qty }}</td>
    		<td style="padding:5px">{{ $detail->getCost() }}</td>
    	</tr>
    @endforeach
    </tbody>
    <tfoot>
    	<tr>
    		<td align="right"><b>Tạm tính</b></td>
    		<td>{{ Web\Helpers\Utils::formatCurrency($order->subtotal) }}</td>
    	</tr>
    	<tr>
    		<td align="right"><b>Thành tiền</b></td>
    		<td>{{ Web\Helpers\Utils::formatCurrency($order->total) }}</td>
    	</tr>
    </tfoot>
</table><br/>
<b>Ghi chú:</b>{{ $order->customer_note }}
<br/><br/>
Nếu Anh/chị có bất kỳ câu hỏi nào, xin liên hệ với chúng tôi qua hotline {{ $order->hotline }}<br/>
Trân trọng<br/>
<br/>
