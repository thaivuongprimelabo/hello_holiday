<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('cms/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->getAvatar() }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Xem trang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('auth.product.list') }}" class="nav-link">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Sản phẩm
              </p>
            </a>
          </li>
          @if(Route::has('auth.category.list'))
          <li class="nav-item">
            <a href="{{ route('auth.category.list') }}" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
              <p>
                Loại sản phẩm
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.product.tag.list'))
          <li class="nav-item">
            <a href="{{ route('auth.product.tag.list') }}" class="nav-link">
            <i class="fas fa-tag nav-icon"></i>
              <p>
                Tags sản phẩm
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.vendor.list'))
          <li class="nav-item">
            <a href="{{ route('auth.vendor.list') }}" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>
                Đối tác
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.order.list'))
          <li class="nav-item">
            <a href="{{ route('auth.order.list') }}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
              <p>
                Đơn hàng
                @if(session()->has('countNewOrders') && session('countNewOrders'))
                <span class="badge-danger badge right">{{ session('countNewOrders') }}</span>
                @endif
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.menu.list'))
          <li class="nav-item">
            <a href="{{ route('auth.menu.list') }}" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
              <p>
                Menu Top
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.banner.list'))
          <li class="nav-item">
            <a href="{{ route('auth.banner.list') }}" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
              <p>
                Slider
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.banner.center'))
          <li class="nav-item">
            <a href="{{ route('auth.banner.center') }}" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
              <p>
                Banner giữa
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.post.list'))
          <li class="nav-item">
            <a href="{{ route('auth.post.list') }}" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
              <p>
                Bài viết
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.post.tag.list'))
          <li class="nav-item">
            <a href="{{ route('auth.post.tag.list') }}" class="nav-link">
            <i class="fas fa-tag nav-icon"></i>
              <p>
                Tags bài viết
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.page.list'))
          <li class="nav-item">
            <a href="{{ route('auth.page.list') }}" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
              <p>
                Trang nội dung
              </p>
            </a>
          </li>
          @endif
          @if(Route::has('auth.contact.list'))
          <li class="nav-item">
            <a href="{{ route('auth.contact.list') }}" class="nav-link">
            <i class="nav-icon fas fa-envelope"></i>
              <p>
                Liên hệ
                @if(session()->has('countNewContacts') && session('countNewContacts'))
                <span class="badge-danger badge right">{{ session('countNewContacts') }}</span>
                @endif
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('auth.user.list') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
              <p>
                Tài khoản
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
