@if($users->count())
@foreach($users as $user)
<tr>
  <td>
    <input type="checkbox" class="primary-id" value="{{ $user->getKey() }}" />
  </td>
  <td>{{ $user->getKey() }}</td>
  <td>{{ $user->name }}</td>
  <td><img src="{{ $user->getAvatar() }}" class="img-thumbnail" style="width:50px" /></td>
  <td>{{ $user->getCreatedAt() }}</td>
  <td>{!! $user->getStatusText() !!}</td>
  <td>{{ $user->email }}</td>
  <td>
    <a href="{{ route('auth.user.edit', ['user' => $user->getKey()]) }}" title="Sửa">
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