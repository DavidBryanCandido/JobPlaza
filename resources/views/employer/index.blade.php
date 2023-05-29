@extends('home')

@section('content')
    <div class="indexBG">
        <div class="jobboardCon">
            @include('includes.searchbar')
            <div class="indexLRcontainer">
                <div class="left">
                    @forelse ($jobs as $job)
                        <div class="jobCard">
                            <div class="status">
                                <p class="{{ $job->status == 0 ? 'Open' : 'Closed' }}">{{ $job->status == 0 ? 'Open' : 'Closed' }}</p>
                            </div>
                            <div class="jobTitle">
                                <h1>{{ $job->title }}</h1>
                            </div>
                            <div class="company_id">
                                <h2>{{ $job->employer ? $job->employer->company_name : 'Unknown Employer' }}</h2>
                            </div>
                            <div class="jobTitle">
                                <p>Location: {{ $job->location }}</p>
                                <p>Salary: {{ $job->salary }}</p>
                                <p>Job type: {{ $job->type }}</p>
                            </div>
                            <div class="viewmore">
                                <button class="view-details-btn" data-job-id="{{ $job->id }}">View details</button>
                            </div>
                            <button class="apply-btn" data-job-id="{{ $job->id }}">Apply</button>
                        </div>
                    @empty
                        <p>No jobs found.</p>
                    @endforelse
                </div>
                <div class="right" id="job-details"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.apply-btn').click(function() {
                var jobId = $(this).data('job-id');
                var url = '/jobs/' + jobId + '/apply';

                // Open a new tab/window with the apply form
                window.open(url, '_blank');
            });
            $('.view-details-btn').click(function() {
                var jobId = $(this).data('job-id');
                var url = '/jobs/' + jobId;

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Update the content of the 'job-details' div with the job details
                        $('#job-details').html(response);
                    },
                    error: function() {
                        console.log('An error occurred while fetching job details.');
                    }
                });
            });
        });
    </script>
@endsection
