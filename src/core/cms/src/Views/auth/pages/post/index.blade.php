@extends('cms::auth.layouts.list')
@section('search')
<table class="table table-hover">
  <thead>
    <tr>
      <th>
        <input type="checkbox" id="check-all" />
      </th>
      <th>ID</th>
      <th>Tựa đề</th>
      <th>Hình ảnh</th>
      <th>Mô tả ngắn</th>
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