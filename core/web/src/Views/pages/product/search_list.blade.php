@foreach($products as $product)
<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
    <div class="product-col">
        @include('web::components.product_block')
    </div>
</div>
@endforeach
@if($products->hasMorePages())
<div id="load_more" class="col-sm-12 col-xs-12 col-md-12 text-center" style="padding: 10px 0px" data-next-page="{{ $products->currentPage() + 1 }}">
    <button class="btn btn-primary">Xem các sản phẩm khác</button>
</div>
@endif