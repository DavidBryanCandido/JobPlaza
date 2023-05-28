<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Register Page</title>
    <link href="{{ asset('css/register.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>  
    <div class="container">
        <div class="header">
            <div class="back">
                <a href="{{ route('jobs.index') }}"><img src="/img/close.png" alt="close"></a>
            </div>  
            <div class="text">
                <p>HELLO & WELCOME</p>
                <h3>to</h3>
            </div>

            <div class="logo">
                <img src="/img/JobPlaza_logov2.png" alt="JobPaza">
            </div>
            <div class="navEmployer-Applicant">
                <div class=" con {{ request()->is('employer/register') ? 'applican-employer' : '' }}">
                    <a href="{{ route('employer.register') }}" class=" {{ request()->is('employer/register') ? 'aa' : 'non' }}" >Employer Register</a>
    
                </div>
                <div class=" con {{ request()->is('applicant/register') ? 'applican-employer' : '' }}">
                    <a href="{{ route('applicant.register') }}" class=" {{ request()->is('applicant/register') ? 'aa' : 'non' }}">Applicant Register</a>
                </div>
            </div>
            
        </div>
        <div class="body">
            <h1><span>Create</span> your account</h1>
            <div class="input">
                <form action="{{ route('employer.register.save') }}" method="POST">
                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <input type="text" name="company_name" id="" placeholder="Company Name" value="{{ old('name') }}">
                    <span class="text-danger"> @error('name'){{ $message }} @enderror</span>
                    <input type="text" name="website" id="" placeholder="website Link" value="{{ old('name') }}">
                    <span class="text-danger"> @error('name'){{ $message }} @enderror</span>
                    <input type="text" name="name" id="" placeholder="Name" value="{{ old('name') }}">
                    <span class="text-danger"> @error('name'){{ $message }} @enderror</span>
                    <input type="email" name="email" id="" placeholder="Email Address" value="{{ old('email') }}">
                    <span class="text-danger"> @error('email'){{ $message }} @enderror</span>
                    <input type="password" name="password" id="" placeholder="Password">
                    <span class="text-danger"> @error('password'){{ $message }} @enderror</span>

                    <button class="btn" type="submit">Sign Up</button>
                </form>
            </div>
            <a class="account" href="{{ route('employer.login') }}">I already have an account <span>sign in</span></a>
        </div>
    </div>
</body>
</html>
