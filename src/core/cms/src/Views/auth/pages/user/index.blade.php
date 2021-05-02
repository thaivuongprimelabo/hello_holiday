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
              <h3 class="card-title">
                {{ $users->links('cms::auth.components.pagination') }}
              </h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
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
                <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td><img src="{{ $user->getAvatar() }}" class="img-thumbnail" style="width:50px" /></td>
                    <td>{{ $user->created_at }}</td>
                    <td>{!! $user->getStatusText() !!}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <a href="{{ route('auth.user.edit', ['user' => $user->id]) }}" title="Sửa">
                        <i class="fa fa-edit"></i>
                      </a>
                      &nbsp;
                      <a href="{{ route('auth.user.remove', ['user' => $user->id]) }}" title="Xóa">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
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
@endsection