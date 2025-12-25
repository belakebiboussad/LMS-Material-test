<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- <title>@yield('title') | {{ config('app.name') }}</title> --}}
    <title>@if (trim($__env->yieldContent('title')))@yield('title') | @endif {{ config('app.name', Lang::get('titles.app')) }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])    
    <style type="text/css">
    @yield('css')
   </style>
</head>

<body class="theme-light-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    <!-- Search Bar -->
    <div class="mdl-layout__header-row">
     <span class="mdl-layout-title">
         @yield('header')
    </span>

    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    </header>

    @include('partials.navbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('partials.sidebar')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        @include('partials.asidebar')
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            {{-- <nav class="breadcrumb"><ul itemscope itemtype="https://schema.org/BreadcrumbList">
                        @yield('breadcrumbs')</ul>    </nav> --}}
            @yield('content')
        </div>
    </section>
    @include('partials.script')
    @yield('js')
    @stack('scripts')
</body>
</html>