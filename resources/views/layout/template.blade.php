<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    {{-- Custom Datepicker --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

    {{-- Local CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @yield('extra-css')
</head>
<body class="min-vh-100 d-flex flex-column m-0 p-0">
    <div class="row m-0 p-0 w-100">
        <!-- Toggle button (only for mobile) -->
        <button id="sidebarToggle" class="btn btn-light d-lg-none position-fixed top-0 start-0 m-3 z-3">
            <i class="bi bi-list fs-3"></i>
        </button>

        <!-- Backdrop (only on mobile) -->
        <div id="sidebarBackdrop" class="d-lg-none position-fixed top-0 start-0 w-100 h-100 bg-dark opacity-50" style="display:none; z-index:3;"></div>

        <div class="d-flex flex-column flex-shrink-0 p-3 m-0 sidebar-app">
            @include('layout.navbar')
        </div>
        <div class="col-12 col-lg-9">
            <main class="flex-fill">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('extra-script')
</body>
</html>
