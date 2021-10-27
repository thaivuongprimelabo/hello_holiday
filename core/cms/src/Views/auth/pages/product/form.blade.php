@extends('cms::auth.layouts.form')
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
                            <input type="hidden" id="id_check" value="{{ $product->getKey() }}" />
                            <input type="hidden" id="type_check" value="product" />
                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên sản phẩm',
                                'name' => 'name',
                                'item' => $product,
                                'maxlength' => 255,
                            ])
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Loại sản phẩm</label>
                                <select class="select2" name="category_id" id="field_category_id"  style="width: 100%;">
                                    <option value="">---</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->getKey() }}" disabled {{ $product->category_id == $category->getKey() ? 'selected' : '' }}>{{ $category->getName() }}</option>
                                    @foreach($category->childCategories as $childCategory)
                                    <option value="{{ $childCategory->getKey() }}" {{ $product->category_id == $childCategory->getKey() ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;|--{{ $childCategory->getName() }}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                                @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            @php
                                $productTags = [];
                                if ($product->tags) {
                                    $productTags = explode(',', $product->tags);
                                }
                            @endphp

                            @include('cms::auth.components.form.select_multiple', [
                                'label' => 'Tags',
                                'name' => 'tags[]',
                                'item' => $productTags,
                                'options' => $tags
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
                                'label' => 'Meta Keywords',
                                'name' => 'seo_keywords',
                                'item' => $product,
                            ])

                            @include('cms::auth.components.form.textarea', [
                                'label' => 'Meta Description',
                                'name' => 'seo_description',
                                'item' => $product
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động',
                                'name' => 'status',
                                'item' => $product,
                                'checked' => true
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Còn hàng',
                                'name' => 'avail_flg',
                                'item' => $product,
                                'checked' => true
                            ])

                        </div>

                        <div class="col-md-6">

                            <div class="form-group" id="image_product"  max-upload="{{ (session('config')->max_upload_list['image_product']) }}">
                                <div class="row">
                                    <button type="button" class="btn btn-sm btn-primary mb-2 ml-2 upload-mutiple-btn"><i class="fa fa-upload"></i> Chọn hình sản phẩm</button>
                                    <span style="font-weight:initial">&nbsp;(Tối đa: {{ \Cms\Constants::formatMemory(session('config')->max_upload_list['image_product']) }}. Định dạng: *.jpg, *.png, *.jpeg)</span>
                                    <input type="hidden" id="size_text" value="{{ \Cms\Constants::formatMemory(session('config')->max_upload_list['image_product']) }}" />
                                </div>
                                <div id="selected_images" class="row">
                                    <div class="col-md-3 col-lg-2 mb-2 clone" style="position: relative; max-height: 120px; display: none">
                                        <button type="button" class="btn btn-sm btn-default mb-2 remove-image-btn"  style="position: absolute; top: 4px; right: 16px;" data-default-image="{{ $product->getDefaultImage() }}"><i class="fa fa-trash"></i></button>
                                        <img src="{{ $product->getAvatar() }}" id="preview" class="img-thumbnail" style="max-height:120px; overflow: hidden" />
                                        <br />
                                        @error('upload_file')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    @if($product->exists)
                                    @foreach($product->imagesProduct as $images)
                                    <div class="col-md-3 col-lg-2 mb-2" style="position: relative; max-height: 120px; overflow: hidden">
                                        <button type="button" class="btn btn-sm btn-default mb-2 remove-image-btn" style="position: absolute; top: 4px; right: 16px;" data-image-id="{{ $images->id }}" data-default-image="{{ $product->getDefaultImage() }}"><i class="fa fa-trash"></i></button>
                                        <img src="{{ $images->getMediumImage() }}" id="preview" class="img-thumbnail" style="max-height:120px; overflow: hidden" />
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
