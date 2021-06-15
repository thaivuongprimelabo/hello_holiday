
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" >
  <title>Admin Panel | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
  @yield('styles')
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
<!-- Select2 -->
<script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Moment -->
<script src="{{ asset('cms/plugins/moment/moment.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('cms/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('cms/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- CK Editor -->
<script src="{{ asset('cms/plugins/ckeditor/ckeditor.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('cms/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('cms/custom.js') }}"></script>
@yield('scripts')
@if (session('success'))
<script>
  $(function() {
    toastr.success("{{ session('success') }}")
  });
</script>
@endif

@if (session('error'))
<script>
  $(function() {
    toastr.error("{{ session('error') }}")
  });
</script>
@endif

@if (isset($errors) && $errors->any())
    @php 
        $errorMsg = '';
    @endphp
    @foreach ($errors->all() as $error)
        @php
            $errorMsg .= $error . '<br/>';
        @endphp
    @endforeach

    <script>
        $(function() {
            toastr.error("{!! $errorMsg !!}")
        });
    </script>
@endif

<script>
  $(function () {
    $('.select2').select2();

    $('#date_from_se, #date_to_se').datetimepicker({
        format: 'yyyy/MM/DD'
    });

    if($('.ckeditor-full').length) {
        $('.ckeditor-full').each(function(e){
            if(!this.id) return;
            CKEDITOR.replace( this.id, {
                filebrowserBrowseUrl : '{{ asset('cms/plugins/kcfinder/browse.php?opener:ckeditor&type:files') }}',
                filebrowserImageBrowseUrl : '{{ asset('cms/plugins/kcfinder/browse.php?opener:ckeditor&type:images') }}',
                filebrowserFlashBrowseUrl : '{{ asset('cms/plugins/kcfinder/browse.php?opener:ckeditor&type:flash') }}',
                filebrowserUploadUrl : '{{ asset('cms/plugins/kcfinder/upload.php?opener:ckeditor&type:files') }}',
                filebrowserImageUploadUrl : '{{ asset('cms/plugins/kcfinder/upload.php?opener:ckeditor&type:images') }}',
                filebrowserFlashUploadUrl : '{{ asset('cms/plugins/kcfinder/upload.php?opener:ckeditor&type:flash') }}',
                height: 500, 
                customConfig: '{{ asset('cms/plugins/ckeditor/editor.full.js') }}' 
            });
        });
    }

    if($('.ckeditor-small').length) {
        $('.ckeditor-small').each(function(e){
            if(!this.id) return;
            CKEDITOR.replace( this.id, {
                height: 200, 
                customConfig: '{{ asset('cms/plugins/ckeditor/editor.small.js') }}' 
            });
        });
    }
    
  });
  
</script>
</body>
</html>
