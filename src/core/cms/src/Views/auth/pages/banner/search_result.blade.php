@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td><img src="{{ $data->getBanner() }}" class="img-thumbnail" style="width:100%; height: 150px" /></td>
    <td><a href="{{ $data->link }}">{{ $data->link }}</a></td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.banner.edit', ['banner' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@endif