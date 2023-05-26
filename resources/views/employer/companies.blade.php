@extends('home')
@section('content')
    {{-- {{ $companies }} --}}
    <div class="companiesBG">
        <div class="companiesCon">
            <div class="searchCon">
                <h1>Find a greate place to work</h1>
                <h3>Company name or Job title</h3>
                <div class="searchIC">
                    <input type="text" >
                    <Button class="button button3">Find Companies</Button>
                </div>
            </div>
            <div class="concon">
                <h1>Companies</h1>
                <div class="companyCon">
                    @foreach ( $employers as $employer )
                        <div class="companyContainer">
                            <div class="companyLogo">
                                @if ($employer->logo)
                                    <img src="{{ asset('storage/' . $employer->logo) }}" alt="Company Logo">

                                @else
                                    <img src="/img/userPf.png" alt="Company Logo">
                                @endif
                            </div>
                            <div class="companyinfo">
                                <h2>{{ $employer->company_name }}</h2>
                                <div class="salalryJobs">
                                    <p><a href="#">Ratings</a></p>
                                    <p><a href="#">Open Jobs</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection