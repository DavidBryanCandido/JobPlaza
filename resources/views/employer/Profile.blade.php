@extends('layouts.app')

@section('content')
    <div class="mainContent">
        @include('includes.nav')
        <div class="innermain">
            <div class="profileContainer">
                <div class="userinfo">
                    <div class="userpf">
                        @if ($employer->logo)
                            <img src="{{ asset('storage/' . $employer->logo) }}" alt="Company Logo">

                        @else
                            <img src="/img/userPf.png" alt="Company Logo">
                        @endif
                        
                    </div>
                    <form action="{{ route('upload.logo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="logo" accept="image/*">
                            <button type="submit">Upload Logo</button>
                        </form>
                </div> 
                <div class="name">
                    <div class="innername">
                        <p>Company: {{ $employer->company_name }}</p>  
                    </div>
                    <div class="innername">
                        <p>Email: {{ $employer->email }}</p>          
                    </div>
                </div>  
            </div>
            <div class="employerdata">
                {{-- here --}}
                <div class="innerEmployeeData">
                    <div class="postedJobs pos">
                        <h2>{{ $employer->jobs->count() }} </h2>
                        <p>You have posted job(s)</p>
                    </div>
                    <div class="pendingJobs pos">
                        <h2>{{ $employer->jobs->where('status', 0)->count() }}</h2>
                        <p>Pending job(s)</p>
                    </div>
                    <div class="closedJobs pos">
                        <h2>{{ $employer->jobs->where('status', 1)->count() }}</h2>
                        <p>Closed job(s)</p>
                    </div>
                </div>
                <div class="applicants">
                    <div class="jobaplicants">
                        <h1>Job Applicants:</h1>
                    </div>
                    <div class="jobapplicantsdata">
                        @foreach ($employer->jobs as $job)
                            <div class="jobtitle">
                                <p>Applicants for "{{ $job->title }}": {{ $job->applications->count() }}</p>
                            </div>
                        @endforeach                        
                    </div>

                </div>
            </div>
        </div>

        
    </div>
@endsection
