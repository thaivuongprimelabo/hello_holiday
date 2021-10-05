@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.post.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tựa đề', 
                                'name' => 'name', 
                                'item' => $post,
                                'maxlength' => 255,
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
                                'image' => $post->getPhoto(),
                                'style' => 'width: 260px;',
                                'demension' => '224x224'
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