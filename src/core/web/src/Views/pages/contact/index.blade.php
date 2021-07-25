@extends('web::layouts.main')
@section('content')
<section class="bread-crumb">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="index.html">
                            <span><i class="fa fa-home"></i> {{ trans('web::label.home') }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    <li><strong>Liên hệ với chúng tôi</strong></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="margin-top-0">
    <div class="container">
        <div class="row">
            
            <div id="content" class="col-sm-12 col-xs-12 col-md-12">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}<button type="button" class="close" data-dismiss="alert">×</button>
                </div>
                @endif
                <div class="section_maps">
                    <div class="title_head">
                        <h1 class="title_center_page title-head-contact">
                            <span>Liên hệ với chúng tôi</span>
                        </h1>
                    </div>
                    <div class="box-maps">
                        <div class="iFrameMap">
                            <div class="google-map">
                                <div id="contact_map" class="map">
                                        <iframe width="100%" 
                                        height="450" 
                                        frameborder="0"
                                        style="border:0"
                                        src="https://maps.google.com/maps?width=100%25&amp;height=450&amp;hl=en&amp;q={{ $config->latlong }}+(Web%20Shop)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                        </iframe>
                                </div>
                                <style>
                                    .google-map {
                                        width: 100%
                                    }

                                    .google-map .map {
                                        width: 100%;
                                        height: 400px;
                                        background: #DEDEDE
                                    }

                                    .google-map .map iframe {
                                        width: 100% !important;
                                        height: 100% !important
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <div class="contact contact-owf">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-top-30">
                                <div class="page_cotact">
                                    <h3 class="title-head-contact a-left">
                                        <span>Địa chỉ của chúng tôi</span>
                                    </h3>
                                </div>
                                <div class="content">
                                    <div class="item_contact">
                                        <div class="body_contact">
                                            <span class="icon_widget"><i class="fa fa-map-marker"></i></span>
                                            <span class="contact_info">
                                                <span class="rc">
                                                    <p>{{ $config->company_name }}</p>
                                                    <button target="_blank" rel="noopener" class="btn btn-info"
                                                        onclick="window.open('https://www.google.com/maps/place/{{ $config->latlong }}', '_blank')">
                                                        <i class="fa fa-map-marker"></i> Xem Bản đồ Google </button>
                                                </span>
                                            </span>
                                        </div>
                                        <div class="body_contact item_2_contact">
                                            <span class="icon_widget"><i class="fa fa-phone"
                                                    aria-hidden="true"></i></span>
                                            <span class="contact_info">
                                                <a class="rc lh" href="tel:0123 456 789">{{ $config->company_phone }}</a>
                                            </span>
                                        </div>
                                        <div class="body_contact item_3_contact">
                                            <span class="icon_widget"><i class="fa fa-clock-o"></i></span>
                                            <span class="contact_info">
                                                <span class="rc">Các ngày trong tuần: 9h00 - 22h00</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-top-30">
                                <div class="page-login page_cotact">
                                    <h3 class="title-head-contact a-left">
                                        <span>Thông tin liên hệ</span>
                                    </h3>
                                    <div id="pagelogin">
                                        <form action="{{ route('contact.index') }}" method="post"
                                            enctype="multipart/form-data" id="contact">
                                            @csrf
                                            <div class="form-signup clearfix">
                                                <div class="row group_contact">
                                                    <fieldset
                                                        class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="input-name">Tên của bạn:</label>
                                                        <input type="text" name="name" value="" id="input-name"
                                                            class="form-control form-control-lg" required />
                                                    </fieldset>
                                                    <fieldset
                                                        class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="input-email">Số điện thoại:</label>
                                                        <input type="text" name="phone" value="" id="input-phone"
                                                            class="form-control form-control-lg"
                                                            data-validation="phone" required />
                                                    </fieldset>
                                                    <fieldset
                                                        class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="input-email">Địa chỉ Email:</label>
                                                        <input type="email" name="email" value="" id="input-email"
                                                            class="form-control form-control-lg"
                                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$"
                                                            data-validation="email" required />
                                                    </fieldset>
                                                    <fieldset
                                                        class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label for="input-enquiry">Nội dung:</label>
                                                        <textarea name="content" id="input-enquiry"
                                                            class="form-control content-area form-control-lg" rows="5"
                                                            required></textarea>
                                                    </fieldset>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-10">
                                                        <button type="submit" class="btn btn-primary">Gửi đi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                


            </div>
        </div>
    </div>
</section>
<div class="content_mainbottom">
    <div class="container">
        <div class="row">
        </div>
    </div>
</div>
<section class="awe-section-10 " id="service-0">
    <div class="footer-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="tel:0123456789 ">
                        <div class="hotline">
                            <i class="fa fa-headphones" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">Tư vấn sản phẩm</span>
                                <span class="bottom">0123456789</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="tel:0123456789 ">
                        <div class="hotline">
                            <i class="fa fa-cogs" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">Hỗ trợ kỹ thuật</span>
                                <span class="bottom">0123456789</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="javascript:void(0)">
                        <div class="hotline">
                            <i class="fa fa-truck" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">Giao hàng - Bảo hành</span>
                                <span class="bottom">24H thần tốc</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-6">
                    <a href="javascript:void(0)">
                        <div class="hotline">
                            <i class="fa fa-shield" aria-hidden="true"><b></b></i>
                            <div class="text">
                                <span class="up">Uy tín lâu năm</span>
                                <span class="bottom">Thương hiệu số 1</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection