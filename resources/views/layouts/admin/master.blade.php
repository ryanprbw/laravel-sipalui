<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/images/logo_kalsel.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo_kalsel.png')}}" type="image/x-icon">
    <title>{{ $title }} | SI-PALUI EKSIS</title>
    @includeIf('layouts.admin.partials.css')
</head>
<body class="dark-sidebar">
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader"></div>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
@includeIf('layouts.admin.partials.header')
<!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
        <x-admin.sidebar/>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <!-- Container-fluid starts-->
        {{--        @yield('content')--}}
        {{$slot}}
        <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-md-6 footer-copyright">
                <p class="mb-0">
                    Copyright {{date('Y')}} © Badan Perencanaan Pembangunan Daerah. Version 1.0.0
                </p>
            </div>
            <div class="col-md-6 ">
                <p class="mb-0 pull-right">
                    <img src="{{ asset('assets/images/logo_kalsel.png') }}" width="15" height="15">
                    Pemerintah Provinsi Kalimantan Selatan
                </p>
            </div>
        </div>
    </div>
</footer>
{{ $script }}
</body>
</html>
