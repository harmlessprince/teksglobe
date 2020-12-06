<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    {{--
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
{{--     
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    --}}

    <link rel="stylesheet" href="{{ asset('css/styles-auth.css') }}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
           
            /* padding-top: 40px; */
            /* padding-bottom: 40px; */
        }

    </style>
</head>

<body>
    <div class="dashboard-main-wrapper my_bg">
        @include('partials.navbargen')
        <!-- ============================================================== -->
        <!-- login page  -->
        <!-- ============================================================== -->
        <div class="splash-container">
           
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- end login page  -->
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>

</body>

</html>
    

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Auth Main Layout</h1>
    <h4>Nav Links</h4>
    <ul>
        <li><a href="{{ route('register') }}">Register</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
    </ul>
    <hr>
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
        <hr>
    @endif
    @yield('content')
</body>
</html> --}}
