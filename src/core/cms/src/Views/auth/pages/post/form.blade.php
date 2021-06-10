@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('auth.post.list') }}" class="btn btn-default">
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
                                'label' => 'Tựa đề', 
                                'name' => 'name', 
                                'item' => $post
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tác giả', 
                                'name' => 'author_name', 
                                'item' => $post
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $post,
                                'checked' => true
                            ])
                        </div>

                        <div class="col-md-6">

                            @include('cms::auth.components.form.upload', [
                                'label' => 'Hình bài viết',
                                'name' => 'photo',
                                'item' => $post,
                                'image' => $post->getPhoto()
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('cms::auth.components.form.editor', [
                                'label' => 'Mô tả', 
                                'name' => 'description', 
                                'item' => $post,
                                'small' => true
                            ])

                            @include('cms::auth.components.form.editor', [
                                'label' => 'Nội dung', 
                                'name' => 'content', 
                                'item' => $post
                            ])

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection