@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td><img src="{{ $data->getBanner() }}" class="img-thumbnail" style="width:120px; height: 80px" /></td>
    <td><a href="{{ $data->link }}" target="_blank">{{ $data->link }}</a></td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.banner.edit', ['banner' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@else
<tr>
    <td>{{ trans('cms::auth.no_data_found') }}</td>
</tr>
@endif