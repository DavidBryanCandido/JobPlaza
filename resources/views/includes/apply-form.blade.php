<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>apply-form</title>
    <link href="{{ asset('css/apply.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>
    <div class="container">
        <div class="concon">
            <div class="back">
                <a href="{{ route('jobs.index') }}"><img src="/img/close.png" alt="close"></a>
            </div>
<form action="{{ route('job.applyForm', ['id' => $job->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
<input type="text" name="name" id="name" value="{{ session('LoggedApplicantName') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
<input type="email" name="email" id="email" value="{{ session('LoggedApplicantEmail') }}" required>
                </div>
                <div class="form-group g">
                    <label for="resume">Resume</label>
                    <input type="file" name="resume" id="resume" required>
                </div>
                <button class="btn" type="submit">Submit</button>
            </form>        
        </div>
    </div>
</body>
</html>
