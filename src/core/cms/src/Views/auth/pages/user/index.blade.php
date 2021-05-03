@extends('cms::auth.layouts.main')
@section('content')
<section class="content">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <div class="col-sm-4">
            <a href="{{ route('auth.user.create') }}" class="btn btn-primary btn-block">
              <i class="fas fa-plus"></i>
              Đăng ký mới
            </a>
          </div>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" id="pagination">
                
              </h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" id="keyword" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="button" id="search-btn" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên gọi</th>
                    <th>Ảnh đại diện</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Email</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="search-result">
                  
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
  </div><!-- /.container-fluid -->
</section>
<div id="page-overlay"><i id="loading-spin" class="fas fa-sync fa-spin"></i></div>
@endsection
@section('scripts')
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