@extends('cms::auth.layouts.list')
@section('search')
<table class="table table-hover text-nowrap">
  <thead>
    <tr>
      <th>
        <input type="checkbox" id="check-all" />
      </th>
      <th>ID</th>
      <th>Tên gọi</th>
      <th>Ảnh đại diện</th>
      <th>Ngày tạo</th>
      <th>Trạng thái</th>
      <th>Email</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="search-result">
    
  </tbody>
</table>
@endsection