@if($categories->count())
@foreach($categories as $category)
<tr>
  <td>
    <input type="checkbox" class="primary-id" value="{{ $category->getKey() }}" />
  </td>
  <td>{{ $category->getKey() }}</td>
  <td>{{ $category->name }}</td>
  <td>{{ $category->name_url }}</td>
  <td>{{ $category->parent_id }}</td>
  <td>{{ $category->getCreatedAt() }}</td>
  <td>{!! $category->getStatusText() !!}</td>
  <td>
    <a href="{{ route('auth.category.edit', ['category' => $category->getKey()]) }}" title="Sửa">
      <i class="fa fa-edit"></i>
    </a>
  </td>
</tr>
@endforeach
@else
<tr>
  <td></td>
</tr>
@endif