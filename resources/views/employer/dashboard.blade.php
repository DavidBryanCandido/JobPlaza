<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
            {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Company Dashboard</title>
    <link href="{{ asset('css/dasboard.css') }}" type="text/css" rel="stylesheet"/>
    
</head>
<body>

    <div>
        <h1>Welcome, {{ $employer->name }}</h1>

        <h2>Company: {{ $employer->company_name }}</h2>

        <h3>Your Posted Jobs:</h3>
        @foreach ($jobs as $job)
            <div>
                <h4>{{ $job->title }}</h4>
                <p>{{ $job->description }}</p>
                <!-- Display other job details as needed -->
            </div>
        @endforeach
        <a href="{{ route('logout') }}">Logout</a>
    </div>

</body>
</html>