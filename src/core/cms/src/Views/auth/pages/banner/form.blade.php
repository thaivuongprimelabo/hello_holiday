@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

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
                            @include('cms::auth.components.form.upload', [
                                'label' => 'Banner',
                                'name' => 'banner',
                                'item' => $banner,
                                'image' => $banner->getBanner()
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection