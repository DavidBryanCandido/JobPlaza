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
    $job = Job::findOrFail($id);

    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'resume' => 'required|file|max:2048|mimes:pdf,doc,docx',
    ]);

    // Save the application data
    $application = new Application();
    $application->job_id = $job->id;
    $application->name = $validatedData['name'];
    $application->email = $validatedData['email'];

    // Save the resume file
    if ($request->hasFile('resume')) {
        $resume = $request->file('resume');
        $resumePath = $resume->store('resumes');
        $application->resume = $resumePath;
    }

    $application->save();

    // Optionally, you can redirect the user to a thank-you page or the job details page
    return redirect()->route('jobs.index', $job->id)->with('success', 'Application submitted successfully.');
}

public function viewApplicants($id)
{
    $job = Job::findOrFail($id);

    // Retrieve the applications for the job
    $applications = Application::where('job_id', $job->id)->get();

    // Update the resume file path for each application
    foreach ($applications as $application) {
        $resumePath = 'storage/app/public' . $application->resume;
        $application->resume = Storage::url($resumePath);
    }

    return view('employer.applicants', compact('job', 'applications'));
}





}
