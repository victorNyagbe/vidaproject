<!DOCTYPE html>
<html lang="fr">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | GoProject</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/fonts/google-font.css') }}">
  <!-- Google Font: Source DS-digital -->
  <link rel="stylesheet" href="{{ asset('styles/fonts/DS-DIGIT.TTF') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/fontawesome-free/css/all.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/ionicons/ionicons.css') }}">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/jqvmap/jqvmap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('styles/admin/dist/css/adminlte.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/overlayScrollbars/css/OverlayScrollbars.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('styles/admin/plugins/summernote/summernote-bs4.css') }}">
  <!-- Bootstrap icons -->
  <link href="{{ asset('styles/boot-icons/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('styles/boot-icons/boxicons/css/boxicons.css') }}" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('styles/mdb/css/bootstrap.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('styles/admin/welcome.css') }}">
  @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('admin.includes.navbar')
    @include('admin.includes.sidebar')
    @yield('content')
  </div>

<!-- jQuery -->
<script src="{{ asset('styles/admin/plugins/jquery/jquery.js') }} "></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('styles/admin/plugins/jquery-ui/jquery-ui.js') }} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('styles/admin/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('styles/admin/plugins/chart.js/Chart.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('styles/admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('styles/admin/plugins/jqvmap/jquery.vmap.js') }} "></script>
<script src="{{ asset('styles/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('styles/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('styles/admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('styles/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('styles/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('styles/admin/plugins/summernote/summernote-bs4.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('styles/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('styles/admin/dist/js/adminlte.js') }}"></script>

<script>
  $(document).ready(function() {
    $('#calendar').datetimepicker({
      format: 'L',
      inline: true
    })
  });

</script>

    @yield('script')
</body>
</html>
