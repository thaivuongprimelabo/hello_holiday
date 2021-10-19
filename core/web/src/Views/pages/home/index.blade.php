@extends('web::layouts.main')
@section('content')
<section class="awe-section-1" id="awe-section-1">
    <div class="section_category_slider">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-3 sidebar col-left clearfix no-padding-right">
                    <div id="column-left" class="left-column compliance">
                        @include('web::components.category')
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-9 no-padding-left" style="z-index: 0">
                    @include('web::components.slider')
                </div>
                
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="row">
        <div id="content" class="main">
            @if($categories->count())
            <section class="awe-section-2 container service_banner_custom " id="service_banner-0">
                <div class="banner_owl owl-carousel owl-theme not-aweowl">
                    @foreach($vendors as $vendor)
                    <div class="item">
                        <a href="#">
                            <div class="trend-item">
                                <figure style="display: table-cell; vertical-align: middle; height: 160px">
                                    <img src="{{ $vendor->getLogo() }}" alt="{{ $vendor->getName() }}">
                                </figure>
                                <h4 class="title-banner-custom title-banner-custom-0">{{ $vendor->getName() }}</h4>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            @if(!is_null($bannerCenter))
            <section class="awe-section-4 container main-wrapper banner_custom hidden-xs" id="banner_custom-1">
                <a class="cat-header text-container" href="{{ $bannerCenter->link }}" target="_blank">
                    <img src="{{ $bannerCenter->getBanner() }}" alt="{{ $bannerCenter->link }}">
                </a>
            </section>
            @endif
            
            @foreach($categories as $category)
            @php
                $stt = 1;
                $products = $category->getProducts();
            @endphp
            @if($products->count())
            <section class="awe-section-6 product_bestseller product_by_category " id="product_by_category-{{ $stt }}">
                <section class="section_bedroom">
                    <div class="container">
                        <div class="row row-noGutter-2">
                            <div class="heading">
                                <h2 class="title-head">
                                    <a href="{{ $category->getLink() }}">{{ $category->getName() }}</a>
                                </h2>
                                <a href="{{ $category->getLink() }}" class="more-products d-md-block">Xem thêm <i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i></a>

                            </div>

                            <div class="border_wrap">
                                <div class="owl_product_comback ">
                                    <div class="product_comeback_wrap">
                                        <div class="owl_product_item_content owl-carousel not-dot not-nav3 not-nav"
                                            data-dot="false" data-nav='false' data-autoPlay='true' data-lg-items='4'
                                            data-md-items='4' data-sm-items='3' data-xs-items="2">
                                            @foreach($products as $product)
                                            <div class="item saler_item col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding">
                                                <div class="owl_item_product product-col">
                                                    @include('web::components.product_block')
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </section>
            </section>
            @endif
            @php
                $stt++;
            @endphp
            @endforeach

            @include('web::components.feedback')
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('.banner_owl').owlCarousel({
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 7
                }
            }
        });
    })

    
</script>
@endsection