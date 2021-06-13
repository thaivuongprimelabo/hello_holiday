@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
    <section class="content-header">
    </section>

    <div class="container-fluid">
        <form action="?" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @include('cms::auth.components.form_button', ['route' => 'auth.page.list'])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            @include('cms::auth.components.form.input', [
                                'label' => 'Tựa đề', 
                                'name' => 'name', 
                                'item' => $page
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