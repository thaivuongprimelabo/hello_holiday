@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td>{{ $data->name_url }}</td>
    <td><img src="{{ $data->getLogo() }}" class="img-thumbnail" style="width:100px" /></td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.vendor.edit', ['vendor' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@endif