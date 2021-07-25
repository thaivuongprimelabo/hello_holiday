@if($banners->count())
<section class="awe-section-1 " id="gallery-0">
    <div class="home-slider owl-carousel owl-theme" data-lg-items='1' data-md-items='1'
        data-sm-items='1' data-xs-items="1" data-margin='0' data-dot="true" data-nav='true'>
        @foreach($banners as $banner)
        <div class="item">
            <a href="{{ $banner->link }}" target="_blank">
            <img src="{{ $banner->getBanner() }}" alt="" class="img-responsive" style="width: 100%; height: 450px" /></a>
        </div>
        @endforeach
    </div>
</section>
@endif