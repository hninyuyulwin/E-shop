<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
    <link href="{{ asset('admin/css/material-dashboard.css') }}" rel="stylesheet">
</head>
<body class="g-sidenav-show  bg-gray-200">

  {{--sidebar--}}
  @include('layouts.inc.sidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    @include('layouts.inc.adminnav')    

    <div class="container-fluid py-4">
      <div class="row">
        @yield('content')
      </div>      

      @include('layouts.inc.adminfoot')
    </div>

  </main>


    
  <!--   Core JS Files   -->  
  <script src="{{ asset('admin/js/popper.min.js') }}" ></script>
  <script src="{{ asset('admin/js/bootstrap.min.js') }}" ></script>
  {{--<script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>--}}
  <script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}" ></script>
  <script src="{{ asset('admin/js/smooth-scrollbar.min.js') }}" ></script>

  <script src="{{asset('admin/js/material-dashboard.min.js')}}"></script>

  @yield('scripts')

</body>
</html>
