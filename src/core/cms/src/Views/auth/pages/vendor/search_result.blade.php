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
        <a href="{{ route('auth.vendor.edit', ['vendor' => $data->getKey()]) }}"><i class="fas fa-edit"></i></a>
    </td>
</tr>
@endforeach
@endif