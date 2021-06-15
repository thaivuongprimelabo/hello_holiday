@extends('cms::auth.layouts.main')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Web title', 
                                'name' => 'web_title', 
                                'item' => $webConfig
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Web keywords', 
                                'name' => 'web_keywords', 
                                'item' => $webConfig,
                                
                            ])

                            @include('cms::auth.components.form.textarea', [
                                'label' => 'Web description', 
                                'name' => 'web_description', 
                                'item' => $webConfig,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Company name', 
                                'name' => 'company_name', 
                                'item' => $webConfig
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Company address', 
                                'name' => 'company_address', 
                                'item' => $webConfig
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Company phone', 
                                'name' => 'company_phone', 
                                'item' => $webConfig
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Company email', 
                                'name' => 'company_email', 
                                'item' => $webConfig
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Company tax', 
                                'name' => 'company_tax', 
                                'item' => $webConfig
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Facebook', 
                                'name' => 'facebook_fanpage', 
                                'item' => $webConfig,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Youtube', 
                                'name' => 'youtube_channel', 
                                'item' => $webConfig,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Zalo', 
                                'name' => 'zalo_page', 
                                'item' => $webConfig,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Shopee', 
                                'name' => 'shopee_page', 
                                'item' => $webConfig,
                            ])

                        </div>

                        <div class="col-md-6">
                            @include('cms::auth.components.form.upload', [
                                'label' => 'Web logo',
                                'name' => 'web_logo',
                                'item' => $webConfig,
                                'image' => $webConfig->getWebLogo(),
                                'style' => 'width: 120px; height:120px'
                            ])

                            @include('cms::auth.components.form.upload', [
                                'label' => 'Web icon',
                                'name' => 'web_ico',
                                'item' => $webConfig,
                                'image' => $webConfig->getWebIcon(),
                                'style' => 'width: 40px; height:40px'
                            ])

                            @include('cms::auth.components.form.upload', [
                                'label' => 'Web banner',
                                'name' => 'web_banner',
                                'item' => $webConfig,
                                'image' => $webConfig->getWebBanner(),
                                'style' => 'width: 100%; height:250px'
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection