@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form id="submit-form" action="?" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.menu.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.select', [
                                'label' => 'Chọn menu cha', 
                                'name' => 'parent_menu_id', 
                                'item' => $menu,
                                'options' => $menuParents
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên menu', 
                                'name' => 'name', 
                                'item' => $menu,
                                'maxlength' => 255,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'URL', 
                                'name' => 'url', 
                                'item' => $menu,
                                'maxlength' => 255,
                            ])

                            @include('cms::auth.components.form.select', [
                                'label' => 'Target', 
                                'name' => 'target', 
                                'item' => $menu,
                                'options' => json_decode(json_encode([
                                    [ 'id' => '_blank', 'name' => 'Mở tab mới'],
                                    [ 'id' => '_self', 'name' => 'Mở tab hiện tại'],
                                ]))
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Thứ tự', 
                                'name' => 'order', 
                                'item' => $menu,
                                'type' => 'number',
                                'min' => 1,
                                'max' => 9999,
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $menu,
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