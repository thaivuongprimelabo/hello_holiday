@extends('cms::auth.layouts.main')
@section('content')
@php
  $current = request()->route()->getName();
  $search_route = str_replace('list', 'search', $current);
  $create_route = str_replace('list', 'create', $current);
  $remove_route = str_replace('list', 'remove', $current);
  $restore_route = str_replace('list', 'restore', $current);
@endphp
@hasSection('search_condition')
    @yield('search_condition')
@else
    @include('cms::auth.components.search_condition')
@endif
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <div class="mailbox-controls">
                @if(Route::has($remove_route))
                <div class="btn-group">
                  <button type="button" id="remove-btn" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                    Xoá
                  </button>
                </div>
                @endif
                <!-- /.btn-group -->
                <button type="button" id="reload" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                  Tải lại
                </button>
                @if(Route::has($create_route))
                <a href="javascript:void(0)" id="create-btn" class="btn btn-default btn-sm">
                  <i class="fas fa-plus"></i>
                  Đăng ký mới
                </a>
                @endif

                <div class="float-right">
                    <span id="total-record" class="text-sm"></span>&nbsp;&nbsp;&nbsp;
                    <div class="float-right" id="pagination"></div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            @yield('search')
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>

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
@section('scripts')
@endsection
