@if($searchList->count())
@foreach($searchList as $data)
<tr onclick="window.location='{{ route('auth.product.edit', ['product' => $data->getKey()]) }}'" {!! $data->status === 0 ? 'style="background-color: #eeeeee;"' : '' !!}>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->getName() }}</td>
    <td>{{ $data->name_url }}</td>
    <td>
        @if(!is_null($data->imagesProduct()->first()))
        <img src="{{ $data->imagesProduct()->first()->getSmallImage() }}" class="img-thumbnail" />
        @endif
    </td>
    <td>{{ $data->getPrice() }}</td>
    <td>{{ $data->discount }}</td>
    <td>{{ $data->category->getName() }}</td>
    <td>{{ $data->vendor->getName() }}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>
    </td>
</tr>
@endforeach
@else
<tr>
    <td></td>
</tr>
@endif