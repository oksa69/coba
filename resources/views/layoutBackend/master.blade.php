<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <title>Zmartbook</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{!! asset('assets/css/bootstrap.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/font-awesome.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/bootstrap-combobox.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/sweetalert2.min.css') !!}">
  <!-- jQuery first, then Tether, then Bootstrap JS. -->
  <script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
  <script src="{!! asset('assets/js/tether.min.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
  <script src="{!! asset('assets/js/bootstrap-combobox.js') !!}"></script>
  <script src="{!! asset('assets/js/sweetalert2.min.js') !!}"></script>
</head>
<body style="background-color: #fff0">
  @include('layoutBackend.navbar')
  <div class="container">
    @yield('content')
    <footer class="container-fluid bg-4 text-center">
      <p>2017 © All Rights Reserved. Zmartbook</p>
    </footer>
  </div>
  @include('sweet::alert')
</body>
<script type="text/javascript">
  $(document).ready(function () {
    $('.combobox').combobox();
  });
</script>
</html>