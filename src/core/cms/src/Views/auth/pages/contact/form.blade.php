@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

    <div class="container-fluid">
        <form action="?" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.contact.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Họ tên', 
                                'name' => 'name', 
                                'item' => $contact,
                                'disabled' => true,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'Số ĐT', 
                                'name' => 'phone', 
                                'item' => $contact,
                                'disabled' => true,
                            ])

                            @include('cms::auth.components.form.input', [
                                'label' => 'E-mail', 
                                'name' => 'email', 
                                'item' => $contact,
                                'disabled' => true,
                            ])

                        </div>
                        <div class="col-md-6">
                            
                            @include('cms::auth.components.form.input', [
                                'label' => 'Tựa đề', 
                                'name' => 'subject', 
                                'item' => $contact,
                                'disabled' => true,
                            ])

                            @include('cms::auth.components.form.textarea', [
                                'label' => 'Nội dung', 
                                'name' => 'content', 
                                'item' => $contact,
                                'disabled' => true,
                                'rows' => 4
                            ])
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            @include('cms::auth.components.form.editor', [
                                'label' => 'Trả lời', 
                                'name' => 'reply_content', 
                                'item' => $contact,
                                'small' => true
                            ])
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection