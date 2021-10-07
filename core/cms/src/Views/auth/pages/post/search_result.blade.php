@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->name }}</td>
    <td><img src="{{ $data->getPhoto() }}" class="img-thumbnail" style="width:100px" /></td>
    <td>{!! \Str::limit($data->description, 30) !!}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.post.edit', ['post' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@else
<tr>
    <td>{{ trans('cms::auth.no_data_found') }}</td>
</tr>
@endif