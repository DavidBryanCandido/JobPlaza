@extends('layouts.app')

@section('content')
    <div class="mainContent">
         @include('includes.nav')
         <div class="yourpostedjobcontainer">
             <div class="yourpostedjob">
                 <h3>Your Posted Jobs:</h3>
             </div>
            @foreach ($jobs as $job)
                <div class="jobcon">
                    <div class="d">
                        <p>Title: {{ $job->title }}</p>
                        <p>Location: {{ $job->location }}</p>
                    </div>
                    <div class="d">
                        <p>Job type: {{ $job->type }}</p>
                        <p>Salary: {{ $job->salary }}</p>
                    </div>
                    <div class="d di {{ $job->status == 0 ? 'open' : 'closed' }}">
                        <p>Status: {{ $job->status == 0 ? 'Open' : 'Closed' }}</p>
                        
                    </div>
                    <div class="d i">
                        <form action="{{ route('edit.job.status', $job->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status">
                                <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Open</option>
                                <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Closed</option>
                            </select>
                            <button type="submit">Update Status</button>
                        </form>
                    </div>
                    <!-- Display other job details as needed -->
                </div>
            @endforeach
         </div>

    </div>
@endsection
