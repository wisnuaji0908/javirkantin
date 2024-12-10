<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition login-page">
        @if (session('regis'))            
        <div class="alert alert-primary" role="alert">
            {{ session('regis') }}
          </div>
        @endif
        @include('sweetalert::alert')
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h1>Login Here</h1>
                </div>
                <div class="card-body">
                    <form action="/login" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input autofocus id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="password"/>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            @if (session()->has('loginError'))
                                <small class="text-danger">{{ session('loginError') }}</small>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
    </body>
</html>
