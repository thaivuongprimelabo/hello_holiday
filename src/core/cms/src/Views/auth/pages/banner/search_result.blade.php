@if($searchList->count())
@foreach($searchList as $data)
<tr onclick="window.location='{{ route('auth.banner.edit', ['banner' => $data->getKey()]) }}'" {!! $data->status === 0 ? 'style="background-color: #eeeeee;"' : '' !!}>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td><img src="{{ $data->getBanner() }}" class="img-thumbnail" style="width:100%; height: 150px" /></td>
    <td><a href="{{ $data->link }}">{{ $data->link }}</a></td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
</tr>
@endforeach
@else
<tr>
    <td></td>
</tr>
@endif