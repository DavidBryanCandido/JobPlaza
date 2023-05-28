@extends('auth.applicant.app')

@section('content2')
    <div class="mainContent">
        @include('auth.applicant.nav')
        <div class="innermain">
            <div class="profileContainer">
                <div class="userinfo">
                    <div class="userpf">
                        @if ($applicant->profile_Picture)
                            <img src="{{ asset('storage/' . $applicant->profile_Picture) }}" alt="Profile Picture">


                        @else
                            <img src="/img/userPf.png" alt="Company Logo">
                        @endif
                        
                    </div>
                    <form action="{{ route('applicant.upload.logo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="profile_Picture" accept="image/*">
                            <button type="submit">Upload Logo</button>
                        </form>
                </div> 
                <div class="name">
                    <div class="innername">
                        <p>Email: {{ $applicant->email }}</p>          
                    </div>
                </div>  
            </div>
            <div class="employerdata">
                {{-- here --}}
                <div class="innerEmployeeData">
                    <div class="postedJobs pos">
                        <h2>{{ $applicationCount }}</h2>
                        <p>Application(s)</p>
                    </div>
                    <div class="pendingJobs pos">
                        <h2>{{ $pendingCount }}</h2>
                        <p>Pending</p>
                    </div>
                    <div class="closedJobs pos">
                        <h2>{{ $deniedCount }}</h2>
                        <p>Denied</p>
                    </div>
                    <div class="approvedJobs pos">
                        <h2>{{ $approvedCount }}</h2>
                        <p>Approved</p>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection
