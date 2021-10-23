@extends('cms::auth.layouts.list')
@section('search_condition')
&nbsp;
@endsection
@section('search')
<table class="table table-hover text-nowrap">
  <thead>
    <tr>
      <th>
        <input type="checkbox" id="check-all" />
      </th>
      <th>ID</th>
      <th>Tên gọi</th>
      <th>URL</th>
      <th>Thứ tự</th>
      <th>Trạng thái</th>
      <th>Ngày tạo</th>
      <th>Ngày cập nhật</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="search-result">
    
  </tbody>
</table>
@endsection