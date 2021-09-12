<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>Masuk - SMK Ti Tunas Harapan</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="{{ asset('template/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('template/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('template/plugins/perfectscroll/perfect-scrollbar.css') }}" rel="stylesheet">
        <link href="{{ asset('template/plugins/pace/pace.css') }}" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="{{ asset('template/css/main.min.css') }}" rel="stylesheet">
        <link href="{{ asset('template/css/custom.css') }}" rel="stylesheet">
    </head>
    <body class="login-page">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-4">
                    <div class="card login-box-container">
                        <div class="card-body">
                            <div class="authent-logo">
                                <a href="#">Sistem Informasi Akademik <br> SMK Ti Tunas Harapan</a>
                            </div>
                            <div class="authent-text">
                                <p>Selamat Datang</p>
                                <p>Masuk ke akun anda</p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="floatingInput" placeholder="Email anda" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="floatingInput">Alamat Email</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" id="password" placeholder="Password anda" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <label for="floatingPassword">Kata Sandi</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleCheck1">{{ __('Ingatkan Saya') }}</label>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary m-b-xs">{{ __('Masuk') }}</button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Lupa Kata Sandi?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                            <div class="authent-reg">
                                <p>Belum mendaftar? <a href="register">Daftar</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascripts -->
        <script src="{{ asset('template/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="{{ asset('template/plugins/perfectscroll/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('template/plugins/pace/pace.min.js') }}"></script>
        <script src="{{ asset('template/js/main.min.js') }}"></script>
    </body>
</html>