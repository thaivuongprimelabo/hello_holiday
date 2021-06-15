@if($searchList->count())
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td><b>Tên:</b> {{ $data->name }}<br/><b>Số ĐT:</b> {{ $data->phone }}<br/><b>Email:</b> {{ $data->email }}</td>
    <td>{{ $data->subject }}</td>
    <td>{!! $data->getContactStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route('auth.contact.edit', ['contact' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@endif