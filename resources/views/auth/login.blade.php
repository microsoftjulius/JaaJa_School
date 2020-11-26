<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themicon.co/theme/angle/v4.7.5/static-html/app/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Oct 2020 09:47:10 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Bootstrap Admin App">
<meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
<link rel="icon" type="image/x-icon" href="{{ asset('design/primary.jpg') }}">
<title>JITS - Education System</title><!-- =============== VENDOR STYLES ===============-->
<!-- FONT AWESOME-->
<link rel="stylesheet" href="{{ asset('design/vendor/%40fortawesome/fontawesome-free/css/brands.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/%40fortawesome/fontawesome-free/css/regular.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/%40fortawesome/fontawesome-free/css/solid.css')}}">
<link rel="stylesheet" href="{{ asset('design/vendor/%40fortawesome/fontawesome-free/css/fontawesome.css')}}"><!-- SIMPLE LINE ICONS-->
<link rel="stylesheet" href="{{ asset('design/vendor/simple-line-icons/css/simple-line-icons.css')}}"><!-- =============== BOOTSTRAP STYLES ===============-->
<link rel="stylesheet" href="{{ asset('design/css/bootstrap.css')}}" id="bscss"><!-- =============== APP STYLES ===============-->
<link rel="stylesheet" href="{{ asset('design/css/app.css')}}" id="maincss">
</head>

<body style="background-image: linear-gradient(to bottom, rgba(17, 18, 24, 0.226),  rgba(9, 15, 48, 0.212)), 
    url('{{ asset('design/primary.jpg') }}'); ">
<div class="wrapper"><br><br><br>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            @include('layouts.messages')
        </div>
        <div class="col-lg-3"></div>
    </div>
    <div class="block-center mt-4 wd-xl">
        <!-- START card-->
        <div class="card card-flat">
            {{-- <img src="{{ asset('design/primary.jpg') }}" alt=""> --}}
        <div class="card-header text-center bg-dark"><a href="http://jaajaltd.com/" target="_blank" style="color:red">JITS - EDUCATION</a></div>
        <div class="card-body">
            <p class="text-center py-2">SIGN IN TO CONTINUE.</p>
            <form class="mb-3" id="loginForm" method="post" action="{{ route('login') }}" novalidate >
                @csrf
                <div class="form-group">
                    <div class="input-group with-focus">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <span class="input-group-text text-muted bg-transparent border-left-0"><em class="fa fa-envelope"></em></span>
                        </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group with-focus">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        <div class="input-group-append">
                            <span class="input-group-text text-muted bg-transparent border-left-0"><em class="fa fa-lock"></em></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="clearfix">
                    {{-- <div class="float-right"><a class="text-muted" href="{{ route('password.request') }}">Forgot your password?</a></div> --}}
                </div><button class="btn btn-block btn-danger mt-3" type="submit">Login</button>
            </form>
            {{-- <p class="pt-3 text-center">Need to Signup?</p><a class="btn btn-block btn-secondary" href="{{ route('register') }}">Register Now</a> --}}
        </div>
        </div><!-- END card-->
        <div class="p-3 text-center"><span class="mr-2" style="color: black">&copy;</span><span style="color: black">{{ date('Y') }}</span><span class="mr-2">-</span><span style="color: black">JITS</span><br>
            <span><a href="https://jaajaltd.com" target="_blank" style="color: black">JAAJA Information Technology Solutions</a></span>
        </div>
    </div>
<!-- MODERNIZR-->
<script src="{{ asset('design/vendor/modernizr/modernizr.custom.js')}}"></script><!-- STORAGE API-->
<script src="{{ asset('design/vendor/js-storage/js.storage.js')}}"></script><!-- i18next-->
<script src="{{ asset('design/vendor/i18next/i18next.js')}}"></script>
<script src="{{ asset('design/vendor/i18next-xhr-backend/i18nextXHRBackend.js')}}"></script><!-- JQUERY-->
<script src="{{ asset('design/vendor/jquery/dist/jquery.js')}}"></script><!-- BOOTSTRAP-->
<script src="{{ asset('design/vendor/popper.js/dist/umd/popper.js')}}"></script>
<script src="{{ asset('design/vendor/bootstrap/dist/js/bootstrap.js')}}"></script><!-- PARSLEY-->
<script src="{{ asset('design/vendor/parsleyjs/dist/parsley.js')}}"></script><!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('design/js/app.js')}}"></script>
</body>


<!-- Mirrored from themicon.co/theme/angle/v4.7.5/static-html/app/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Oct 2020 09:47:10 GMT -->
</html>