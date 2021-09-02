@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">

    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.banner.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Link bài viết', 
                                'name' => 'link', 
                                'item' => $banner,
                                'maxlength' => 255,
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $banner,
                                'checked' => true
                            ])
                        </div>

                        <div class="col-md-6">
                            @include('cms::auth.components.form.upload', [
                                'label' => 'Banner',
                                'name' => 'banner',
                                'item' => $banner,
                                'image' => $banner->getBanner(),
                                'style' => 'width: 100%; height:250px',
                                'demension' => '850x480'
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection