@extends('layouts.app')

@section('content')
    <div class="mainContent">
        <div class="applicantContainer">
            <div class="applicantHeader">
                <h1> All Applicants</h1>
            </div>
            <div class="apcon">
            @foreach ($job->application as $application)
                <div class="applicantCon">
                    <div class="applicantLeft">
                        <p>{{ $application->name }}</p>
                        <p>{{ $application->email }}</p>
                        <p><a href="{{ $application->resume }}" download>Download Resume</a></p>
                    </div>
                    <div class="applicantcenter">
                        <p>{{ $application->status }}</p>
                    </div>
                    <div class="applicantRight">
                        <form action="{{ route('application.approve', $application->id) }}" method="POST">
                             @csrf
                            <button type="submit">Approve</button>
                        </form>
                        <form action="{{ route('application.deny', $application->id) }}" method="POST">
                            @csrf
                            <button type="submit">Deny</button>
                        </form>
                        <form action="{{ route('application.delete', $application->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>                        
                    </div>
                </div>
            @endforeach                
            </div>

            {{-- <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Resume</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($job->application as $application)
                        <tr>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->email }}</td>
                            <td>
                                <a href="{{ $application->resume }}" download>Download Resume</a>
                            </td>
                            <td>{{ $application->status }}</td>
                            <td>
                                <form action="{{ route('application.approve', $application->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Approve</button>
                                </form>
                                <form action="{{ route('application.deny', $application->id) }}" method="POST">
                                    @csrf
                                    <button type="submit">Deny</button>
                                </form>
                                <form action="{{ route('application.delete', $application->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
        </div>
    </div>
@endsection
