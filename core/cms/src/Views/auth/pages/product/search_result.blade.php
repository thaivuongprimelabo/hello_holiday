@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.product.edit', ['product' => $data->getKey()])
        ])
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->getName() }}</td>
    <td>
        @if(!is_null($data->imagesProduct()->first()))
        <img src="{{ $data->imagesProduct()->first()->getSmallImage() }}" class="img-thumbnail" />
        @endif
    </td>
    <td>{{ $data->getPrice() }}</td>
    <td>{{ $data->discount }}</td>
    <td>{{ optional($data->category)->getName() }}</td>
    <td>{{ optional($data->vendor)->getName() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.product.edit', ['product' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@else
<tr>
    <td>{{ trans('cms::auth.no_data_found') }}</td>
</tr>
@endif