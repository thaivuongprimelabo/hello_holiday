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
                        <a href="{{ route('auth.banner.list') }}" class="btn btn-default">
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

                            @include('cms::auth.components.form.input', [
                                'label' => 'Link bài viết', 
                                'name' => 'link', 
                                'item' => $banner
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $banner,
                                'checked' => true
                            ])
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Banner</label>
                                <br/>
                                <button type="button" id="upload-avatar-btn" class="btn btn-primary mb-2"><i class="fa fa-upload"></i> Tải lên</button>
                                <button type="button" id="remove-avatar-btn" class="btn btn-danger mb-2" data-default-image="{{ $banner->getDefaultImage() }}"><i class="fa fa-trash"></i> Xóa</button><br/>
                                <input type="file" name="upload_file" id="upload-avatar-file" style="display:none" />
                                <img src="{{ $banner->getBanner() }}" id="preview" class="img-thumbnail" style="width:100%;" />
                                <input type="hidden" id="current-avatar" name="current_avatar" value="{{ $banner->banner }}" />
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