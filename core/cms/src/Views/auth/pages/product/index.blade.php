@extends('cms::auth.layouts.list')
@section('search')
<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="check-all" />
            </th>
            <th></th>
            <th>ID</th>
            <th>Tên gọi</th>
            <th>Hình ảnh</th>
            <th>Giá bán (đ)</th>
            <th>Giảm giá (%)</th>
            <th>Loại SP</th>
            <th>NCC</th>
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