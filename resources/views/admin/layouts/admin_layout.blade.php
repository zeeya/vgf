<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('admin') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('admin') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('admin') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->
    @stack('css')
    <!-- End Google Tag Manager -->
</head>
<body class="">

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<!-- BEGIN SIDEBAR -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    @include('admin.layouts.navbars.sidebar')
</nav>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="main-content">
    @include('admin.layouts.headers.auth')
@yield('content')
</div>
<!-- END CONTENT -->


<script src="{{ asset('admin') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('admin') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>


<!-- Argon JS -->
<script src="{{ asset('admin') }}/js/argon.js?v=1.0.0"></script>

@stack('scripts')
</body>
</html>
