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
                        <a href="{{ route('auth.vendor.list') }}" class="btn btn-default">
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
                                <input type="text" class="form-control" name="name" value="{{ old('name', $vendor->name) }}" placeholder="Vui lòng nhập">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="checkboxPrimary1" {{ old('status', $vendor->status) ? 'checked' : '' }} name="status">
                                    <label for="checkboxPrimary1">Đang hoạt động</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logo</label>
                                <br/>
                                <button type="button" id="upload-avatar-btn" class="btn btn-primary mb-2"><i class="fa fa-upload"></i> Tải lên</button>
                                <button type="button" id="remove-avatar-btn" class="btn btn-danger mb-2" data-default-image="{{ $vendor->getDefaultImage() }}"><i class="fa fa-trash"></i> Xóa</button><br/>
                                <input type="file" name="upload_file" id="upload-avatar-file" style="display:none" />
                                <img src="{{ $vendor->getLogo() }}" id="preview" class="img-thumbnail" style="width:150px" />
                                <input type="hidden" id="current-avatar" name="current_avatar" value="{{ $vendor->avatar }}" />
                                <br/>
                                @error('upload_file')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection