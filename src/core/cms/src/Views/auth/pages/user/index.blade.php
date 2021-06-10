@extends('cms::auth.layouts.list')
@section('search_condition')
<div class="container-fluid">
  <form id="search-form" action="enhanced-results.html">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-3">
                    @include('cms::auth.components.form.input', [
                        'label' => 'Thông tin tài khoản', 
                        'name' => 'user_info_se', 
                    ])
                </div>
                <div class="col-3">
                    @include('cms::auth.components.form.select', [
                        'label' => 'Trạng thái', 
                        'name' => 'status_se', 
                        'options' => json_decode(json_encode(\Cms\Constants::$statusList), FALSE)
                    ])
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>Ngày tạo:</label>
                        <div class="input-group date" id="date_from_se" data-target-input="nearest">
                          <input type="text" name="date_from_se" class="form-control datetimepicker-input" data-target="#date_from_se"  data-toggle="datetimepicker" placeholder="Từ ngày" />
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="input-group date" id="date_to_se" data-target-input="nearest">
                          <input type="text" name="date_to_se" class="form-control datetimepicker-input" data-target="#date_to_se"  data-toggle="datetimepicker" placeholder="Đến ngày" />
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="row">
                            <a href="javascript:void(0)" id="search-btn" class="btn btn-warning">
                                <i class="fas fa-search"></i>
                                Tìm kiếm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
  </form>

</div><!-- /.container-fluid -->
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