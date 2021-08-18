@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form action="?" method="post" id="submit-form" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.page.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tựa đề', 
                                'name' => 'name', 
                                'item' => $page,
                                'maxlength' => 255,
                            ])
                        </div>

                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            @include('cms::auth.components.form.editor', [
                                'label' => 'Nội dung', 
                                'name' => 'content', 
                                'item' => $page
                            ])

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection