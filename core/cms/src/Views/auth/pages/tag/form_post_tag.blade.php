@extends('cms::auth.layouts.form')
@section('content')
<section class="content pt-2">
    <div class="container-fluid">
        <form id="submit-form" action="?" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-default">
                @php
                    $list = str_replace('create', 'list', request()->route()->getName());
                    $list = str_replace('edit', 'list', $list);
                @endphp
                @include('cms::auth.components.form_button', ['route' => $list])
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" id="id_check" value="{{ $tag->getKey() }}" />
                            <input type="hidden" id="type_check" value="post_tag" />
                            @include('cms::auth.components.form.input', [
                                'label' => 'Tag name', 
                                'name' => 'name', 
                                'item' => $tag,
                                'maxlength' => 255,
                            ])

                            @include('cms::auth.components.form.checkbox', [
                                'label' => 'Đang hoạt động', 
                                'name' => 'status', 
                                'item' => $tag,
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