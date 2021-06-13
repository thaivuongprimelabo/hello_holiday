@extends('cms::auth.layouts.list')
@section('search')
<table class="table table-hover">
    <colgroup> 
        <col span="1" style="width: 5%;">
        <col span="1" style="width: 5%;">
        <col span="1" style="width: 35%;">
        <col span="1" style="width: 20%;">
    </colgroup>
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="check-all" />
            </th>
            <th>ID</th>
            <th>Banner</th>
            <th>URL</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="search-result">
        
    </tbody>
</table>
@endsection