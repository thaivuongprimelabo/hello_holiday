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
                      <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Vui lòng nhập">
                      @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"  placeholder="Vui lòng nhập" {{ $user->exists ? 'disabled' : '' }} >
                      @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Mật khẩu</label>
                      <input type="password" class="form-control" name="password" value="{{ old('password', $user->password) }}"  placeholder="Vui lòng nhập">
                      @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                      <input type="password" class="form-control" name="password_confirmation" value="{{ old('conf_password', $user->password) }}" placeholder="Vui lòng nhập">
                      @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                  </div>

                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="checkboxPrimary1" checked="{{ old('status', $user->status) }}" name="status">
                      <label for="checkboxPrimary1">Đang hoạt động</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Ảnh đại diện</label>
                      <br/>
                      <button type="button" class="btn btn-primary mb-2" onclick="document.getElementById('upload-avatar').click()"><i class="fa fa-upload"></i> Tải lên</button>
                      <button type="button" class="btn btn-danger mb-2"><i class="fa fa-trash"></i> Xóa</button><br/>
                      <input type="file" name="avatar" id="upload-avatar" style="display:none" />
                      <img src="{{ $user->getAvatar() }}" class="img-thumbnail" style="width:150px" />
                  </div>
                </div>
              </div>
              
            </div>
        </div>
      </form>
  </div>
</section>
@endsection