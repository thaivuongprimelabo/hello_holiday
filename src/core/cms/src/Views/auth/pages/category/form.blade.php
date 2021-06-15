@extends('cms::auth.layouts.main')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form id="submit-form" action="?" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.category.list'])
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