<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Employer;
use App\Models\Application;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function showCreateForm()
    {
        return view('includes.create');
    }

    public function create(Request $request)
    {
        // Get the logged-in employer's ID
        $employerId = session('LoggedUser');

        // Validate the job data
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'type' => 'required',
            'salary' => 'required',
        ], [
            'title.required' => 'The job title is required.',
            'description.required' => 'The job description is required.',
            'location.required' => 'The job location is required.',
            'type.required' => 'The job type is required.',
            'salary.required' => 'The job salary is required.',
        ]);

        // Create a new job instance and set its attributes
        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->location = $request->location;
        $job->type = $request->type;
        $job->salary = $request->salary;
        $job->employer_id = $employerId;

        // Save the job to the database
        $job->save();

        // Redirect to the employer's dashboard
        return redirect()->route('layout.app')->with('success', 'Job created successfully.');
    }

    public function editStatus(Request $request, Job $job)
    {
        // Validate the request
        $request->validate([
            'status' => 'required',
        ]);

        // Update the job status
        $job->status = $request->status;
        $job->save();

        // Redirect back or to a specific page
        return redirect()->back()->with('success', 'Job status updated successfully.');
    }

    public function index()
    {
        $jobs = Job::where('status', 0)->get();
        return view('employer.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);

        return view('includes.job-details', ['job' => $job])->render();
    }
    public function applyForm($id)
    {
        $job = Job::findOrFail($id);
        return view('includes.apply-form', ['job' => $job]);
    }


public function apply(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048', // Limit allowed file types and size
    ]);

    // Get the uploaded file
    $resumeFile = $request->file('resume');

    // Generate a unique name for the file
    $resumeFileName = time() . '_' . $resumeFile->getClientOriginalName();

    // Store the uploaded file in the public disk
    $resumeFile->storeAs('public/resumes', $resumeFileName);

    // Create a new application
    $application = new Application();
    $application->job_id = $id;
    $application->name = $request->name; // Set the name from the form data
    $application->email = $request->email; // Set the email from the form data
    $application->resume = $resumeFileName; // Save the file name in the database
    $application->save();

    // Optionally, you can redirect the user to a thank-you page or the job listing page
    return redirect()->route('job.index')->with('success', 'Application submitted successfully.');
}



}
