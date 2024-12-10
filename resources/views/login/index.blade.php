<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset("css/login.css") }}" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Login Page</title>
</head>

<body>
    @include('sweetalert::alert')
    <div class="input">
        <h1>Login</h1>
        <form action="/login" method="POST">
            @csrf
            <div class="box-input">
                <i class="fas fa-user"></i>
                <input type="text" name="name" autofocus id="name" class="@error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Password">
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="input-group button-logins-cuy">
                <button type="submit" class="btn-input" name="login">Login</button>
            </div>
            @if (session()->has('loginError'))
                <p class="invalid-feedback h1">{{ session('loginError') }}</p>
            @endif

            <div class="bottom">
                <p>Belum punya akun?
                    <a href="/register">Register disini</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>
