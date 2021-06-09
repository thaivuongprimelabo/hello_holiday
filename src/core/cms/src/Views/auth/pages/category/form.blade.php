@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

    <div class="container-fluid">
        <form action="?" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('auth.category.list') }}" class="btn btn-default">
                            <i class="fa fa-chevron-left"></i>
                            Quay lại
                        </a>
                    </h3>
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
                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên loại sản phẩm', 
                                'name' => 'name', 
                                'item' => $category
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $category,
                                'checked' => true
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection