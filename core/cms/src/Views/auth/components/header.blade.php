<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">{{ trans('cms::' . Route::currentRouteName()) }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('auth.config.edit') }}" role="button">
                <i class="nav-icon fas fa-cog"></i>
                Cài đặt
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('auth.logout') }}" role="button">
                <i class="fas fa-sign-out-alt"></i>
                Thoát
            </a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->
