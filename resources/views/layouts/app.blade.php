<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSRF Token -->

    <title>{{ config('app.name', 'Laravel') }}@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head-css')

    <style>
      nav {
        margin-bottom: 40px;
      }
    </style>
  </head>

  <body>
    @include('inc.navbar')
    <div class="container" id="app">
      @yield('content')
    </div>
    @yield('script')
    @include('inc.footer')
  </body>
</html>
