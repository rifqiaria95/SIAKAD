<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        
        <!-- Title -->
        <title>Daftar - SMK Ti Tunas Harapan</title>

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
                                <a href="#">Sistem Akademik SMK Ti Tunas Harapan</a>
                            </div>
                            <div class="authent-text">
                                <p>Selamat Datang</p>
                                <p>Daftar untuk membuat akun</p>
                            </div>

                            {!! Form::open(['url' => '/postregister']) !!}
                                @csrf
                                <div class="mb-3">
                                    {!! Form::text('nama_depan', '', ['class' => 'form-control', 'placeholder' => 'Nama Depan']) !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::text('nama_belakang', '', ['class' => 'form-control', 'placeholder' => 'Nama Belakang']) !!}
                                </div>
                                <div class="form-select mb-3" aria-label="Default select example">
                                    {!!Form::select('jenis_kelamin', ['' => 'Pilih Jenis Kelamin', 'L' => 'Laki-Laki', 'P' => 'Perempuan'], ['style' => 'display:none;'])!!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::text('agama', '', ['class' => 'form-control', 'placeholder' => 'Agama']) !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::textarea('alamat', '', ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                </div>
                                <div class="mb-3">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                </div>
                                <div class="mb-3 form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Saya menyetujui <a href="#">Terms and Conditions</a></label>
                                </div>
                                <div class="d-grid">
                                    <input type="submit" value="Kirim" class="btn btn-primary m-b-xs">
                                </div>
                            {!! Form::close() !!}
                              <div class="authent-login">
                                  <p>Sudah punya akun? <a href="login">Masuk</a></p>
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