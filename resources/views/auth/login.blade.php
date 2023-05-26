<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Login Page</title>
    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet"/>

</head>
<body>  
    <div class="container">
        <div class="header">
            <div class="back">
                <a href="/"><img src="/img/close.png" alt="close"></a>
            </div>  
            <div class="text">
                <p>WELCOME BACK! </p>
                <h3>to</h3>
            </div>

            <div class="logo">
                <img src="/img/JobPlaza_logov2.png" alt="JobPaza">
            </div>

        </div>
        <div class="body">
            <h1><span>Login</span> your account</h1>
            <div class="input">
                <form action="{{ route('login.check') }}" method="post">
                    @csrf
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    <input type="email" name="email" id="" placeholder="Email Address" value="{{ old('email') }}">
                    <span class="text-danger"> @error('email'){{ $message }} @enderror</span>
                    <input type="password" name="password" id="" placeholder="Password">
                    <span class="text-danger"> @error('password'){{ $message }} @enderror</span>

                    <button  class="btn" type="submit">Log In</button>
                </form>
            </div>

            <a class="account" href="{{ route('register') }}">I don't have an account, <span>create new</span></a>
        </div>
    </div>

</body>
</html>