@if($searchList->count())
@php
    $editRoute = str_replace('search', 'edit', request()->route()->getName());
@endphp
@foreach($searchList as $data)
<tr>
    <td>
        <input type="checkbox" class="primary-id" value="{{ $data->getKey() }}" />
    </td>
    <td>{{ $data->getKey() }}</td>
    <td>{{ $data->getName() }}</td>
    <td>{{ $data->getSlug() }}</td>
    <td>{!! $data->getStatusText() !!}</td>
    <td>{{ $data->getCreatedAt() }}</td>
    <td>{{ $data->getUpdatedAt() }}</td>
    <td>
        @include('cms::auth.components.form.link', [
            'link' => route($editRoute, ['tag' => $data->getKey()])
        ])
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7">{{ trans('cms::auth.no_data_found') }}</td>
</tr>
@endif