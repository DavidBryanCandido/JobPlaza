@extends('auth.applicant.app')

@section('content2')
    <div class="mainContent">
         @include('auth.applicant.nav')
         <div class="yourpostedjobcontainer">
             <div class="yourpostedjob">
                 <h3>Your Applications:</h3>
             </div>
           @foreach ($applications as $application)
                <div class="jobcon">
                    <div class="d">
                        <p>Title: {{ $application->job->title }}</p>
                        <p>Location: {{ $application->job->location }}</p>
                    </div>
                    <div class="d">
                        <p>Job type: {{ $application->job->type }}</p>
                        <p>Salary: {{ $application->job->salary }}</p>
                    </div>
                    <div class="d di @if($application->status == 'pending') pending @elseif($application->status == 'accepted') accepted @elseif($application->status == 'rejected') rejected @endif">
                        <p>Status: {{ $application->status }}</p>
                    </div>
                    <!-- Display other job details as needed -->

                    <!-- Display job owner's information -->
                    <div class="d nc">
                        <p>Name: {{ $application->job->employer->name }}</p>
                        <p>Company Name: {{ $application->job->employer->company_name }}</p>
                        <p>Email: {{ $application->job->employer->email }}</p>
                        @if ($application->job->employer->logo)
                            <img class="clogo" src="{{ asset('storage/' . $application->job->employer->logo) }}" alt="Logo">
                        @else
                            <img src="/img/default-logo.png" alt="Default Logo">
                        @endif
                    </div>
                </div>
            @endforeach

         </div>
    </div>
@endsection
