<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/images/logo_kalsel.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo_kalsel.png')}}" type="image/x-icon">
    <title>Login | SI-PALUI EKSIS</title>
    @includeIf('layouts.admin.partials.css')
</head>
<body style="">
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>
<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="login-card">
                <form action="{{ route('login') }}" method="post" class="theme-form login-form">
                    @csrf
                    <h4 class="text-center">FORM LOGIN</h4>
                    <div class="login-social-title mt-2">
                        <h5>Si-PALUI EKSIS</h5>
                        <p style="font-size: 12pt; text-align: center; color: black">Sistem Informasi Penghapusan
                            Kemiskinan Ekstrem Berbasis Geospasial
                            Terintegerasi.</p>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group"><span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input class="form-control" type="text" name="username" required placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input class="form-control" id="password-content" type="password" name="password"
                                   required placeholder="*********">
                            <span class="input-group-text">
                                <i toggle="#password-content" class="bi bi-eye-slash toggle-password"></i>
                                </span>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="/" class="btn btn-danger btn-block"><i class="bi bi-house"></i> Back Home</a>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block" id="btn-login">Sign in</button>
                        </div>
                    </div>
                    <br>
                    <div class="login-social-title">
                        <h5>BAPPEDA KALSEL</h5>
                    </div>

                    <div class="form-group">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@includeIf('layouts.admin.partials.js')
<script>
    $('.toggle-password').click(function () {
        let input = $($(this).attr("toggle"));
        if (input.length > 0) {
            $(this).toggleClass("bi-eye bi-eye-slash");
            input.attr("type") === "password" ? input.attr("type", "text") : input.attr("type", "password");
        }
    });
    $('.login-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            beforeSend: () => {
                $('#btn-login').html(`<i class="bi bi-arrow-repeat"></i> Loading . . .`).prop('disabled', true)
            },
            complete: () => {
                $('#btn-login').html(`Log in`).prop('disabled', false)
            },
            success: (response) => {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success Login',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        window.location.reload();
                    })
                } else {
                    Swal.fire('Failed', response.message, 'error')
                }
            },
            error: (jqXHR, textStatus, errorThrown) => {
                Swal.fire('The Internet?', 'That thing is still around?', 'error');
            }
        })
        return false;
    });
</script>
</body>
</html>
