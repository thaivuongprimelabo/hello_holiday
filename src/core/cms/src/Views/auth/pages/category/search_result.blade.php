@if($searchList->count())
@foreach($searchList as $data)
<tr onclick="window.location='{{ route('auth.category.edit', ['category' => $data->getKey()]) }}'" {!! $data->status === 0 ? 'style="background-color: #eeeeee;"' : '' !!}>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td>{{ $data->name_url }}</td>
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