@extends('cms::auth.layouts.main')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form action="?" id="submit-form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.product.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên sản phẩm',
                                'name' => 'name',
                                'item' => $product
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Loại sản phẩm',
                                'name' => 'category_id',
                                'item' => $product,
                                'options' => $categories
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Nhà cung cấp',
                                'name' => 'vendor_id',
                                'item' => $product,
                                'options' => $vendors
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Giá bán (vnđ)',
                                'name' => 'price',
                                'item' => $product,
                                'type' => 'number'
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Giảm giá (%)',
                                'name' => 'discount',
                                'item' => $product,
                                'type' => 'number'
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'SEO Keywords',
                                'name' => 'seo_keywords',
                                'item' => $product
                            ])

                            @include('cms::auth.components.form.textarea', [
                                'label' => 'SEO Description',
                                'name' => 'seo_description',
                                'item' => $product
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động',
                                'name' => 'status',
                                'item' => $product,
                                'checked' => true
                            ])

                        </div>

                        <div class="col-md-6">

                            <div class="form-group" id="image_product"  max-upload="{{ (\Cms\Constants::MAX_UPLOAD_PRODUCT * 1024) }}">
                                <div class="row">
                                    <button type="button" class="btn btn-sm btn-primary mb-2 ml-2 upload-mutiple-btn"><i class="fa fa-upload"></i> Chọn hình sản phẩm</button>
                                    <span style="font-weight:initial">(Tối đa: {{ \Cms\Constants::$maxUploadText['image_product'] }}. Định dạng: *.jpg, *.png, *.jpeg)</span>
                                </div>
                                <div id="selected_images" class="row">
                                    <div class="col-md-3 mb-2 clone" style="position: relative; display: none">
                                        <button type="button" class="btn btn-sm btn-default mb-2 remove-image-btn"  style="position: absolute; top: 4px; right: 16px;" data-default-image="{{ $product->getDefaultImage() }}"><i class="fa fa-trash"></i></button>
                                        <img src="{{ $product->getAvatar() }}" id="preview" class="img-thumbnail" style="width:100px;" />
                                        <br />
                                        @error('upload_file')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    @if($product->exists)
                                    @foreach($product->imagesProduct as $images)
                                    <div class="col-md-3 mb-2" style="position: relative;">
                                        <button type="button" class="btn btn-sm btn-default mb-2 remove-image-btn"  style="position: absolute; top: 4px; right: 16px;" data-image-id="{{ $images->id }}" data-default-image="{{ $product->getDefaultImage() }}"><i class="fa fa-trash"></i></button>
                                        <img src="{{ $images->getMediumImage() }}" id="preview" class="img-thumbnail" style="width:100px;" />
                                        <br />
                                        @error('upload_file')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('cms::auth.components.form.editor', [
                                'label' => 'Mô tả ngắn',
                                'name' => 'description',
                                'item' => $product,
                                'small' => true
                            ])

                            @include('cms::auth.components.form.editor', [
                                'label' => 'Chi tiết',
                                'name' => 'summary',
                                'item' => $product
                            ])

                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection
