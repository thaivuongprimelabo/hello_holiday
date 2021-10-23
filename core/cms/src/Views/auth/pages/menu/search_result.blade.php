@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->getName() }}</td>
    <td>{{ $data->getUrl() }}</td>
    <td>
        <input type="number" class="update-order" value="{{ $data->order }}" style="width: 60px;" data-id="{{ $data->getKey() }}" />
        <input type="hidden" id="update_order_hidden_{{ $data->getKey() }}" value="{{ $data->order }}" />
    </td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.menu.edit', ['menu' => $data->getKey()])
        ])
    </td>
</tr>
@if($data->childMenus)
@foreach($data->childMenus as $childData)
<tr style="background-color: #f0f0f0;">
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $childData->getKey() }}</td>
    <td style="padding-left: 40px;">{{ $childData->getName() }}</td>
    <td>{{ $childData->getUrl() }}</td>
    <td>
        <input type="number" class="update-order" value="{{ $childData->order }}" style="width: 60px;"  data-id="{{ $childData->getKey() }}" />
        <input type="hidden" id="update_order_hidden_{{ $childData->getKey() }}" value="{{ $childData->order }}" />
    </td>
    <td>{!! $childData->getStatusText() !!}</td>
    <td>{{ $childData->getCreatedAt() }}</td>
    <td>{{ $childData->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.menu.edit', ['menu' => $childData->getKey()])
        ])
    </td>
</tr>
@endforeach
@endif
@endforeach
@else
<tr>
    <td colspan="8">{{ trans('cms::auth.no_data_found') }}</td>
</tr>
@endif