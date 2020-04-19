<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MMS') }}</title>
    <meta content="Mess management system " name="description" />
    <meta content="AAKA" name="author" />
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/metismenu.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    @stack('head_styles')

</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
@include('layouts.partials.header')
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
@include('layouts.partials.sidebar')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">

            @include('layouts.partials.content_page_title')
                <!-- end page-title -->

           <div class="content_wrap">
          @yield('content')
          @yield('content1')
          @yield('content2')
          @yield('content3')
          @yield('content4')
          @yield('content5')
          @yield('contentedit')
          @yield('contentda')
           </div>

            </div>
            <!-- container-fluid -->

        </div>
        <!-- content -->

      @include('layouts.partials.footer')

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->
@section('footerScripts')
    @include('layouts.partials.footer_scripts')
    @show



</body>

</html>
