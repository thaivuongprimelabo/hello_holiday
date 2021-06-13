@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td>{{ $data->name_url }}</td>
    <td><img src="{{ $data->getPhoto() }}" class="img-thumbnail" style="width:100px" /></td>
    <td>{!! $data->description !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.post.edit', ['post' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@endif