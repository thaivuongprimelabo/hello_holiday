@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
  <section class="content-header">
  </section>
  
  <div class="container-fluid">
      <form action="?" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                <a href="{{ route('auth.user.list') }}" class="btn btn-default">
                    <i class="fa fa-chevron-left"></i>
                    Quay lại
                </a>
              </h3>
              <div class="card-tools">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save"></i>
                    Lưu
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tên gọi</label>
                      <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}" placeholder="Vui lòng nhập">
                      @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Loại cha</label>
                      <select class="form-control select2">
                      </select>
                      @error('parent_id')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="checkboxPrimary1" checked="{{ old('status', $category->status) }}" name="status">
                      <label for="checkboxPrimary1">Đang hoạt động</label>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
        </div>
      </form>
  </div>
</section>
@endsection