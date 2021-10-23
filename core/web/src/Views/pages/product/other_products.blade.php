@foreach($products as $product)
<div class="item saler_item col-lg-3 col-md-12 col-sm-12 col-xs-12 no-padding">
    <div class="owl_item_product product-col">
        @include('web::components.product_block')
    </div>
</div>
@endforeach
@if($products->hasMorePages())
<div id="load_more" class="col-sm-12 col-xs-12 col-md-12 text-center" style="padding: 10px 0px" data-next-page="{{ $products->currentPage() + 1 }}">
    <button class="btn btn-primary">Xem các sản phẩm khác</button>
</div>
@endif