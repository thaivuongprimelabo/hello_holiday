@if($searchList->count())
@foreach($searchList as $data)
<tr onclick="window.location='{{ route('auth.user.edit', ['user' => $data->getKey()]) }}'">
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td><img src="{{ $data->getAvatar() }}" class="img-thumbnail" style="width:80px" /></td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->email }}</td>
</tr>
@endforeach
@else
<tr>
    <td></td>
</tr>
@endif