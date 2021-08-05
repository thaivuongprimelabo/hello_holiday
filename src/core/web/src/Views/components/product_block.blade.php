<div class="product-box" style="background: #ffffff;">
    <div class="product-thumbnail">
        @if($product->discount)
        <div class="sale-flash hot">Sale</div>
        @endif
        <a class="image_link display_flex"
            href="{{ $product->getLink() }}"
            title="{{ $product->getName() }}">
            <img src="{{ !is_null($product->imagesProduct()->first()) ? $product->imagesProduct()->first()->getMediumImage() : asset('cms/dist/img/boxed-bg.jpg') }}"
                alt="{{ $product->getName() }}" />
        </a>
        <div class="summary_grid hidden-xs hidden-sm hidden-md">
            <div class="rte description">
                <p>
                </p>
            </div>
        </div>
        <div class="product-action-grid clearfix">
            <form class="variants form-nut-grid">
                <div>
                    <button
                        class="btn-cart button_wh_40 left-to buy-now"
                        data-id="{{ $product->getKey() }}"
                        title="{{ trans('web::label.button.buy_now') }}" type="button">{{ trans('web::label.button.buy_now') }}</button>
                    <a title="{{ trans('web::label.button.show') }}"
                        href="{{ $product->getLink() }}"
                        class="button_wh_40 btn_view right-to quick-view">{{ trans('web::label.button.show') }}</a>
                </div>
            </form>
        </div>
    </div>
    <div class="product-info effect a-left">
        <div class="info_hhh">
            <h4 class="product-name product-name-hover">
                <a href="{{ $product->getLink() }}"
                    title="{{ $product->getName() }}">{{ $product->getName() }}</a>
            </h4>
            <div class="price-box clearfix">
                @if($product->discount)
                <span class="price product-price">{{ $product->getDiscountPrice() }}</span>
                <span class="price product-price-old">{{ $product->getPrice() }}</span>
                <span class="sale-off">-{{ $product->discount }}%</span>
                @else
                <span class="price product-price">{{ $product->getPrice() }}</span>
                @endif
            </div>
        </div>
    </div>
</div>