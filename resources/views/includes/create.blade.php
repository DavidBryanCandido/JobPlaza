@extends('layouts.app')
@section('content')
    
<div class="mainContent">
    <div class="card">
            <div class="card-header">
                Post a Job
            </div>
            <div class="card-body">
                <form class="formmore" action="{{ route('job.create') }}" method="post">
                    @csrf
                    <div class="innerbody">
                        <div class="f">
                            <div class="inputCon job-name">
                                <input type="text" name="title" class="form-input" placeholder="Job title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="inputCon job-location ">
                                <input type="text" name="location" class="form-input" placeholder="Location: country, city, street, zip code" >
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="inputCon job-salary ">
                                <input type="text" name="salary" class="form-input" placeholder="Salary: monthly, yearly">
                                    @error('salary')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="inputCon job-type">
                                <select id="jobs" name="type" class="inputCon-field">
                                    <div >
                                        <option value="" disabled selected>Select job type</option>
                                        <option value="Full-Time">Full-Time</option>
                                        <option value="Part-Time">Part-Time</option>
                                    </div>
                                </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="btn">
                                <button type="submit" class="button button2" >Post Job</button>
                            </div>
                        </div>
                        <div class="inputCon job-decs ">
                            <div class="desc">
                                <p class="inputCon-label">Descriptions</p>
                            </div>
                            <textarea name="description" class="textArea" id="text-area" cols="115" rows="20" ></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection