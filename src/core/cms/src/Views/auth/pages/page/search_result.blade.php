@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td>{{ $data->name_url }}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        <a href="{{ route('auth.page.edit', ['page' => $data->getKey()]) }}"><i class="fas fa-edit"></i></a>
    </td>
</tr>
@endforeach
@endif