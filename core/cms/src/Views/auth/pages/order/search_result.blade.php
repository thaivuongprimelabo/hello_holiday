@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>
        <b>Họ tên:</b> {{ $data->customer_name }}<br/>
        <b>Địa chỉ:</b> {{ $data->getCustomerAddress() }}<br/>
        <b>Số ĐT:</b> {{ $data->customer_phone }}<br/>
        <b>E-mail:</b> {{ $data->customer_email }}<br/>
    </td>
    <td>{{ $data->getTotal() }}</td>
    <td>{!! $data->getOrderStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.order.edit', ['order' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@else
<tr>
    <td>{{ trans('cms::auth.no_data_found') }}</td>
</tr>
@endif