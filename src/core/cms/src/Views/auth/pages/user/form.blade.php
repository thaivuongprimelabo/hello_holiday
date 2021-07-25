@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.user.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tên gọi', 
                                'name' => 'name', 
                                'item' => $user
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Email', 
                                'name' => 'email', 
                                'item' => $user
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Phone', 
                                'name' => 'phone', 
                                'item' => $user
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Address', 
                                'name' => 'address', 
                                'item' => $user
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Mật khẩu', 
                                'name' => 'password',
                                'type' => 'password'
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Xác nhận mật khẩu', 
                                'name' => 'password_confirmation',
                                'type' => 'password'
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $user,
                                'checked' => true
                            ])

                        </div>

                        <div class="col-md-6">
                            @include('cms::auth.components.form.upload', [
                                'label' => 'Ảnh đại diện',
                                'name' => 'avatar',
                                'item' => $user,
                                'image' => $user->getAvatar(),
                                'style' => 'width:150px'
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection