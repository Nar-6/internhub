<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('storage/1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Interhub - Trellix</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
         @media (width >= 628px ) {
            .login-card {
                right: auto !important;
                left: auto !important;
            }   
        }
    </style>
</head>
<body class="formulaire" style="background: url({{ asset('storage/bg2.svg') }}) fixed;  background-size: cover;background-repeat: no-repeat; background-position: center;">
    <div class="login-card">
        <h3>INTERNHUB</h3>
        <form action="{{ route('admin.login')}}" method="POST" class="login-form">
            @csrf
            <input type="email" name="email" id="email" placeholder="Mail" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            
            <a href="#">Forgot password ?</a>
            <button type="submit">Log in</button>
        </form>
    
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
    
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>

