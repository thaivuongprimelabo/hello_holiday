@if($users->count())
@foreach($users as $user)
<tr>
  <td>{{ $user->id }}</td>
  <td>{{ $user->name }}</td>
  <td><img src="{{ $user->getAvatar() }}" class="img-thumbnail" style="width:50px" /></td>
  <td>{{ $user->created_at }}</td>
  <td>{!! $user->getStatusText() !!}</td>
  <td>{{ $user->email }}</td>
  <td>
    <a href="{{ route('auth.user.edit', ['user' => $user->id]) }}" title="Sửa">
      <i class="fa fa-edit"></i>
    </a>
    &nbsp;
    <a href="{{ route('auth.user.remove', ['user' => $user->id]) }}" title="Xóa">
      <i class="fa fa-trash"></i>
    </a>
  </td>
</tr>
@endforeach
@else
<tr>
  <td></td>
</tr>
@endif