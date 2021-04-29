@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
  <section class="content-header">
  </section>
  
  <div class="container-fluid">
      <form action="{{ route('auth.user.create') }}" method="post">
        @csrf
        <div class="card card-default">
            <div class="card-header">
                <div class="card-tools">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i>
                        Lưu
                    </button>
                </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Tên gọi</label>
                  <input type="email" class="form-control" name="name" placeholder="Vui lòng nhập">
                  @error('name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Vui lòng nhập">
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Mật khẩu</label>
                  <input type="email" class="form-control" name="password" placeholder="Vui lòng nhập">
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                  <input type="email" class="form-control" name="conf_password" placeholder="Vui lòng nhập">
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Ảnh đại diện</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Xóa</span>
                    </div>
                  </div>
              </div>

              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="checkbox" id="checkboxPrimary1" checked="true" name="status">
                  <label for="checkboxPrimary1">Đang hoạt động</label>
                </div>
              </div>
            </div>
        </div>
      </form>
  </div>
</section>
@endsection