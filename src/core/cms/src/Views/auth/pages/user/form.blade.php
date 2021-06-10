@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{ route('auth.user.list') }}" class="btn btn-default">
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