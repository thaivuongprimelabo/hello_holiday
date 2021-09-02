@extends('web::layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <section class="bread-crumb">
            <div class="col-xs-12">
                <ul class="breadcrumb">
                    <li class="home">
                        <a href="index.html">
                            <span><i class="fa fa-home"></i> {{ trans('web::label.home') }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    @if(!is_null($product->category))
                    <li class="">
                        <a href="{{ $product->category->getLink() }}">
                            <span>{{ $product->category->getName() }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    @endif
                    @if(!is_null($product->childCategory))
                    <li class="">
                        <a href="{{ $product->childCategory->getLink() }}">
                            <span>{{ $product->childCategory->getName() }}</span>
                        </a>
                        <span><i class="fa">/</i></span>
                    </li>
                    @endif
                    <li><strong>{{ $product->getName() }}</strong></li>
                </ul>
                <div class="alert alert-success" id="cart-success" style="display: none;">
                    Bạn đã thêm <a href="#">{{ $product->getName() }}</a> vào <a href="{{ route('cart.index') }}">giỏ hàng</a>!<button type="button" class="close" data-dismiss="alert">×</button>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="details-product">
    <div class="container">
        <div class="product-detail">
            <div class="row">
                <div id="content" class="col-sm-12 col-xs-12 col-md-9 ">
                    <div class="row">
                        <div class="product-detail-left product-images col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="">
                                <div class="col_large_default large-image">
                                    <a href="{{ optional($product->imagesProduct()->first())->getLargeImage() }}"
                                        class="large_image_url checkurl">
                                        <img id="img_01" class="img-responsive" alt="{{ $product->getName() }}"
                                            src="{{ optional($product->imagesProduct()->first())->getMediumImage() }}"
                                            data-zoom-image="{{ optional($product->imagesProduct()->first())->getLargeImage() }}" />
                                    </a>
                                </div>
                                <div class="aaa">
                                    <div id="gallery_02"
                                        class="owl-carousel owl-theme thumbnail-product thumb_product_details not-dqowl"
                                        data-loop="false" data-play="false" data-lg-items="3" data-md-items="3"
                                        data-sm-items="3" data-xs-items="3" data-xxs-items="3">
                                        @foreach($product->imagesProduct as $imageProduct)
                                        <div class="item">
                                            <a href="{{ $imageProduct->getLargeImage() }}"
                                                data-image="{{ $imageProduct->getMediumImage() }}"
                                                data-zoom-image="{{ $imageProduct->getLargeImage() }}">
                                                <img src="{{ $imageProduct->getSmallImage() }}"
                                                    alt="{{ $product->getName() }}" />
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 details-pro">
                            <h1 class="title-product">{{ $product->getName() }}</h1>
                            <div class="group-status">
                                <span class="first_status">
                                    Tình trạng:
                                    <span class="status_name availabel">{{ $product->avail_flg ? trans('web::label.available') : trans('web::label.out_of_stock') }}</span>
                                </span>
                            </div>
                            @if($product->discount)
                            <div class="price-box">
                                <span class="special-price">
                                    <span class="price product-price">{{ $product->getDiscountPrice() }}</span>
                                </span>
                                <span class="old-price">
                                    <del class="price product-price-old">{{ $product->getPrice() }}</del>
                                </span>
                            </div>
                            @else
                            <div class="price-box">
                                <span class="special-price">
                                    <span class="price product-price">{{ $product->getPrice() }}</span>
                                </span>
                            </div>
                            @endif
                            <div class="product-summary product_description margin-bottom-0">
                                <div class="rte description text4line rte-summary">
                                </div>
                            </div>
                            <div class="form-product col-sm-12">
                                <div id="product">
                                    <form id="add-to-cart-form" class="form-inline margin-bottom-0">
                                        <div class="form-group form_button_details">
                                            @if($product->avail_flg && $product->price > 0)
                                            <div class="form_hai ">
                                                <div
                                                    class="custom input_number_product custom-btn-number form-control">
                                                    <button class="btn_num num_1 button button_qty"
                                                        onClick="var result = document.getElementById('input-quantity'); var qtypro = result.value; if( !isNaN( qtypro ) && qtypro >= 1 ) result.value--;return false;"
                                                        type="button">-</button>

                                                    <input type="text" name="quantity" value="1" size="2"
                                                        id="input-quantity" class="form-control prd_quantity" />

                                                    <button class="btn_num num_2 button button_qty"
                                                        onClick="var result = document.getElementById('input-quantity'); var qtypro = result.value; if( !isNaN( qtypro )) result.value++;return false;"
                                                        type="button">+</button>
                                                </div>
                                                <div class="button_actions">
                                                    <button type="button" class="btn btn-lg button-buy add-to-cart" data-id="{{ $product->getKey() }}">
                                                        <span class="btn-content">{{ trans('web::label.button.add_to_cart') }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-sm-12">
                                {!! $product->description !!}
                                </div>
                            </div>
                            <div class="social-sharing ">
                                <div class="social-media" data-permalink="ghe-tap-ta-da-nang-nms-005.html">
                                    <div class="social-buttons">
                                        <a rel="nofollow" target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            title="Chia sẻ lên Facebook">
                                            <img alt="Chia sẻ lên Facebook" width="25"
                                                src="{{ asset('web/theme/default/image/social/facebook.png') }}" />
                                        </a>
                                        <a rel="nofollow" target="_blank"
                                            href="https://twitter.com/share?text=&amp;url={{ url()->current() }}"
                                            title="Chia sẻ lên Twitter">
                                            <img alt="Chia sẻ lên Twitter" width="25"
                                                src="{{ asset('web/theme/default/image/social/twitter.png') }}" />
                                        </a>
                                    </div>
                                    <style type="text/css">
                                        .social-buttons {
                                            display: block;
                                            width: 100%;
                                        }

                                        .social-buttons a {
                                            display: inline-block;
                                            border-radius: 5px;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                        <div class="row margin-top-50 xs-margin-top-15 margin-bottom-30">
                            <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12 no-padding">
                                <div class="product-tab e-tabs">
                                    <ul class="tabs tabs-title clearfix nav nav-pills">
                                        <li class="tab-link" data-toggle="pill" href="#tab-description" style="padding: 0px 25px !important">
                                            <h3><span>Mô tả</span></h3>
                                        </li>
                                        <li class="tab-link" data-toggle="pill" href="#tab-review" style="padding: 0px 25px !important">
                                            <h3><span>Bình luận</span></h3>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-description" class="tab-pane fade in active">
                                            {!! $product->summary !!}
                                        </div>
                                        <div id="tab-review" class="tab-pane fade in active">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <aside class="col-sm-12 col-xs-12 col-md-3 sidebar right right-content clearfix">
                    <div id="column-right" class="right-column compliance">
                        <div class="module_service_details " id="service-0">
                            <div class="wrap_module_service">
                                <div class="item_service">
                                    <div class="wrap_item_">
                                        <div class="content_service">
                                            <i class="fa fa-headphones"></i>
                                            <p>Tư vấn sản phẩm</p>
                                            <span>
                                                <p>{{ $config->phone1 }}</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item_service">
                                    <div class="wrap_item_">
                                        <div class="content_service">
                                            <i class="fa fa-cogs"></i>
                                            <p>Hỗ trợ kỹ thuật</p>
                                            <span>
                                                <p>{{ $config->phone2 }}</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item_service">
                                    <div class="wrap_item_">
                                        <div class="content_service">
                                            <i class="fa fa-truck"></i>
                                            <p>Giao hàng - Bảo hành</p>
                                            <span>
                                                <p>24H thần tốc</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item_service">
                                    <div class="wrap_item_">
                                        <div class="content_service">
                                            <i class="fa fa-shield"></i>
                                            <p>Uy tín lâu năm</p>
                                            <span>
                                                <p>Thương hiệu số 1</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript"
    src="{{ asset('web/theme/main/javascript/jquery.elevatezoom.minc788.js') }}"></script>
<script type="text/javascript">
    var ww = $(window).width();
    $(document).ready(function () {
        $('#gallery_02 a').on('click', function (e) {
            e.preventDefault()
        });
        if (ww > 991) {
            $('#img_01').elevateZoom({
                gallery: 'gallery_02',
                zoomWindowWidth: 300,
                zoomWindowHeight: 300,
                zoomWindowOffetx: 0,
                easing: true,
                scrollZoom: true,
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: true,
                loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
            });
        } else {
            $('#gallery_02 a').on('click', function (e) {
                var image = $(this).attr('href');
                $(".large_image_url.checkurl").attr('href', image).find('#img_01').attr('src', image).attr('data-zoom-image', image);
            });
        }
    });
</script>
@endsection