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
<body class="landing-wrraper">
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper landing-page">
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- header start-->
    @includeIf('layouts.landing.partials.header')
    <!-- header end-->
        <!--home section start-->
        {{ $slot }}

        <div class="sub-footer">
            <div class="custom-container">
                <div class="row">
                    <div class="col-md-6 col-sm-2">
                        <div class="footer-contain">
                            <img src="{{ asset('assets/images/logo_kalsel.png') }}" width="15" height="15">
                            &nbsp; Pemerintah Provinsi Kalimantan Selatan
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-10">
                        <div class="footer-contain">
                            <p class="mb-0">Copyright 2021-22 © Badan Perencanaan Pembangunan Daerah. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--footer end-->
    </div>
</div>
@stack('scripts')
{{ $script }}
</body>
</html>
