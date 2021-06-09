@extends('cms::auth.layouts.main')
@section('content')
@php
  $current = request()->route()->getName();
  $search_route = str_replace('list', 'search', $current);
  $create_route = str_replace('list', 'create', $current);
  $remove_route = str_replace('list', 'remove', $current);
  $restore_route = str_replace('list', 'restore', $current);
@endphp
<section class="content">
  <section class="content-header">
    @yield('search_condition')
  </section>
</section>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title" id="pagination">
            
          </h3>
          <div class="card-tools">
            <!-- <div class="justify-content-end"> -->
              <div class="row justify-content-end mr-2">
                @if(Route::has($create_route))
                <a href="javascript:void(0)" id="create-btn" class="btn btn-primary">
                  <i class="fas fa-plus"></i>
                  Đăng ký mới
                </a>
                @endif
                &nbsp;&nbsp;&nbsp;
                @if(Route::has($remove_route))
                <a href="javascript:void(0)" id="remove-btn" class="btn btn-danger">
                  <i class="fas fa-trash"></i>
                  Xóa
                </a>
                @endif
                &nbsp;&nbsp;&nbsp;
                @if(Route::has($restore_route))
                <a href="javascript:void(0)" id="restore-btn" class="btn btn-success">
                  <i class="fas fa-trash-restore"></i>
                  Khôi phục
                </a>
                @endif
              </div>
            <!-- </div> -->
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          @yield('search')
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <h3 id="total-record" class="card-title"></h3>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
<div id="page-overlay"><i id="loading-spin" class="fas fa-sync fa-spin"></i></div>
@php

@endphp
@if(Route::has($search_route))
<input type="hidden" id="search_url" value="{{ route($search_route) }}" />
@endif
@if(Route::has($create_route))
<input type="hidden" id="create_url" value="{{ route($create_route) }}" />
@endif
@if(Route::has($remove_route))
<input type="hidden" id="remove_url" value="{{ route($remove_route) }}" />
@endif
@if(Route::has($restore_route))
<input type="hidden" id="restore_url" value="{{ route($restore_route) }}" />
@endif
@endsection
@section('styles')
<style>
  #page-overlay {
    position: fixed; /* Sit on top of the page content */
    display: none; /* Hidden by default */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
  }
  #loading-spin{
    position: absolute;
    top: 50%;
    left: 60%;
    transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
  }
</style>
@endsection
@section('scripts')
@endsection
