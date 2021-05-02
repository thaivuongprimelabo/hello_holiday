
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  @include('cms::auth.components.header')
  @include('cms::auth.components.sidebar')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('cms::auth.components.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>
@if (session('success'))
<script>
  $(function() {
    toastr.success("{{ session('success') }}")
  });
</script>
@endif
</body>
</html>
