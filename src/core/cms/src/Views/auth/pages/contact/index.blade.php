@extends('cms::auth.layouts.list')
@section('search_condition')
<div class="container-fluid">
    <form id="search-form" action="enhanced-results.html">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label>Ngày gửi:</label>
                            <div class="input-group date" id="date_from_se" data-target-input="nearest">
                                <input type="text" name="date_from_se" class="form-control form-control-sm datetimepicker-input" data-target="#date_from_se" data-toggle="datetimepicker" placeholder="Từ ngày" />
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div class="input-group date" id="date_to_se" data-target-input="nearest">
                                <input type="text" name="date_to_se" class="form-control form-control-sm datetimepicker-input" data-target="#date_to_se" data-toggle="datetimepicker" placeholder="Đến ngày" />
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        @include('cms::auth.components.form.button_search')
                    </div>
                </div>

            </div>

        </div>

    </form>

</div><!-- /.container-fluid -->
@endsection
@section('search')
<table class="table table-hover">
  <thead>
    <tr>
      <th>
        <input type="checkbox" id="check-all" />
      </th>
      <th>ID</th>
      <th>Thông tin người gửi</th>
      <th>Tựa đề</th>
      <th>Ngày gửi</th>
      <th>Trạng thái</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="search-result">
    
  </tbody>
</table>
@endsection