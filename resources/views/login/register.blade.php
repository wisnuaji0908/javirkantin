<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Register Page</title>
</head>

<body>
    <div class="input">
        <h1>Registrasi</h1>
        <form action="/register" method="POST">
            @csrf
            <div class="box-input">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Name">
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
            </div>
            <input type="hidden" name="role" value="member">
            <button type="submit" name="register" class="btn-input">Register</button>
            <div class="bottom">
                <p>Sudah punya akun?
                    <a href="/login">Login disini</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>
