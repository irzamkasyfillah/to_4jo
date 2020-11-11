<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <script type="text/javascript" src="ckeditor/ckeditor.js"></script> --}}

    @yield('css')
    
</head>
@yield('body')
    {{-- JQUERY --}}
    <script src="/app-assets/js/core/libraries/jquery.min.js"></script>

    <div id="app">
        
        @yield('header')
        <main class="">
            @yield('content')
        </main>
    @yield('js')
    @include('admin.footer')
</body>
</html>
