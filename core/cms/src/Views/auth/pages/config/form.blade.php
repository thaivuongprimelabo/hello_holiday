@extends('cms::auth.layouts.form')
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
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4>Web Info</h4>
                                </div>
                                <div class="card-body">
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

                                    @include('cms::auth.components.form.upload', [
                                        'label' => 'Web logo',
                                        'name' => 'web_logo',
                                        'item' => $webConfig,
                                        'image' => $webConfig->getWebLogo(),
                                        'style' => 'width: 120px;',
                                        'demension' => '270x100'
                                    ])

                                    @include('cms::auth.components.form.upload', [
                                        'label' => 'Web icon',
                                        'name' => 'web_ico',
                                        'item' => $webConfig,
                                        'image' => $webConfig->getWebIcon(),
                                        'style' => 'width: 40px;',
                                        'demension' => '80x80'
                                    ])

                                    @include('cms::auth.components.form.upload', [
                                        'label' => 'Web banner',
                                        'name' => 'web_banner',
                                        'item' => $webConfig,
                                        'image' => $webConfig->getWebBanner(),
                                        'style' => 'width: auto;',
                                        'demension' => '800x354'
                                    ])

                                    @include('cms::auth.components.form.editor', [
                                        'label' => 'Web footer', 
                                        'name' => 'footer', 
                                        'item' => $webConfig,
                                        'small' => true
                                    ])

                                    @include('cms::auth.components.form.editor', [
                                        'label' => 'Bank info', 
                                        'name' => 'bank_info', 
                                        'item' => $webConfig,
                                        'small' => true
                                    ])

                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Web Lat Long', 
                                        'name' => 'latlong', 
                                        'item' => $webConfig,
                                        'small' => true
                                    ])

                                </div>
                            </div>

                            <div class="card card-default">
                                <div class="card-header">
                                    <h4>Company Info</h4>
                                </div>
                                <div class="card-body">
                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Company name', 
                                        'name' => 'company_name', 
                                        'item' => $webConfig,
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

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="card card-default">
                                <div class="card-header">
                                    <h4>Hỗ trợ khách hàng</h4>
                                </div>
                                <div class="card-body">
                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Tư vấn sản phẩm', 
                                        'name' => 'phone1', 
                                        'item' => $webConfig,
                                    ])

                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Hỗ trợ kĩ thuật', 
                                        'name' => 'phone2', 
                                        'item' => $webConfig,
                                    ])

                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Gọi mua hàng', 
                                        'name' => 'phone3', 
                                        'item' => $webConfig,
                                    ])

                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Gọi khiếu nại', 
                                        'name' => 'phone4', 
                                        'item' => $webConfig,
                                    ])

                                    @include('cms::auth.components.form.input', [
                                        'label' => 'Gọi bảo hành', 
                                        'name' => 'phone5', 
                                        'item' => $webConfig,
                                    ])
                                </div>
                            </div>

                            <div class="card card-default">
                                <div class="card-header">
                                    <h4>Mạng xã hội</h4>
                                </div>
                                <div class="card-body">
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
                            </div>
                            
                            @if(Auth::user()->role_id == 0)
                            <div class="card card-default">
                                <div class="card-header">
                                    <h4>Cài đặt khác</h4>
                                </div>
                                <div class="card-body">
                                    @include('cms::auth.components.form.textarea', [
                                        'label' => 'Max upload', 
                                        'name' => 'max_upload', 
                                        'item' => $webConfig,
                                    ])

                                    @include('cms::auth.components.form.textarea', [
                                        'label' => 'Resize image', 
                                        'name' => 'resize_image', 
                                        'item' => $webConfig,
                                    ])
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection