@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td><img src="{{ $data->getAvatar() }}" class="img-thumbnail" style="width:80px" /></td>
    <td>{{ $data->email }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.user.edit', ['user' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@endif