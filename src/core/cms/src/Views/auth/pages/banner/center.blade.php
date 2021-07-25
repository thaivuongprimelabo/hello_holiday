@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">

    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-tools">
                        @include('cms::auth.components.form.button', [
                            'type' => 'submit',
                            'icon' => 'fas fa-save',
                            'label' => 'Lưu'
                        ])
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            
                            @include('cms::auth.components.form.input', [
                                'label' => 'Link', 
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

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('cms::auth.components.form.upload', [
                                'label' => 'Banner',
                                'name' => 'banner',
                                'item' => $banner,
                                'image' => $banner->getBanner(),
                                'style' => 'width: 100%; height:225px'
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection