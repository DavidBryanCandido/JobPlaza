<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


class ApplicantController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.applicant.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:16'
        ]);

        $applicant = Applicant::where('email', $request->email)->first();

        if (!$applicant) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            if (Hash::check($request->password, $applicant->password)) {
                // Store applicant details in the session
                $request->session()->put('LoggedApplicant', $applicant->id);
                $request->session()->put('LoggedApplicantName', $applicant->name);
                $request->session()->put('LoggedApplicantEmail', $applicant->email);
                
                return redirect()->route('applicant.app');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }


    public function showRegistrationForm()
    {
        return view('auth.applicant.register');
    }

    public function register(Request $request)
    {
        // Handle registration logic
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:applicants',
            'password' => 'required|min:5|max:16',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle the logo file upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $profile_PicturePath = $logo->store('employer-logos', 'public');
        } else {
            $profile_PicturePath = null;
        }

        // Insert data into the database
        $applicant = new Applicant;
        $applicant->name = $request->name;
        $applicant->email = $request->email;
        $applicant->password = Hash::make($request->password);
        $applicant->profile_Picture = $profile_PicturePath; // Store the logo path in the 'profile_Picture' column
        $save = $applicant->save();

        if ($save) {
            return Redirect::route('applicant.login')->with('success', 'New user has been successfully registered. Please login to continue.');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    public function dashboard()
    {
        // Get the logged-in applicant's ID
        $applicantId = session('LoggedApplicant');

        // Retrieve the applicant and their applications with the associated job
        $applicant = Applicant::findOrFail($applicantId);
        $applications = $applicant->applications()->with('job')->get();
        $applicationCount = $applications->count();

        return view('auth.applicant.dashboard', compact('applicant', 'applications', 'applicationCount'));
    }


    public function logout()
    {
        if (session()->has('LoggedApplicant')) {
            session()->forget('LoggedApplicant');
        }

        return redirect('/');
    }

    public function show()
    {
        $applicantId = session('LoggedApplicant');

        // Retrieve the applicant and their applications
        $applicant = Applicant::findOrFail($applicantId);
        $applications = $applicant->applications;
        $applicationCount = $applications->count();
        $pendingCount = $applications->where('status', 'pending')->count();
        $deniedCount = $applications->where('status', 'denied')->count();

        // Count the approved applications directly from the database
        $approvedCount = $applicant->applications()->where('status', 'approved')->count();

        // Retrieve the job owner's information for each application
        $applications->load('job.employer');

        return view('auth.applicant.profile', compact('applicant', 'applications', 'applicationCount', 'pendingCount', 'deniedCount', 'approvedCount'));
    }



    public function uploadLogo(Request $request)
    {
        $request->validate([
            'profile_Picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_Picture')) {
            $profile_Picture = $request->file('profile_Picture');
            $filename = 'profile_Picture_' . time() . '.' . $profile_Picture->getClientOriginalExtension();

            // Store the uploaded logo in the storage/app/public directory
            Storage::disk('public')->put($filename, file_get_contents($profile_Picture));

            // Update the employer's logo in the database
            $applicant = Applicant::find(session('LoggedApplicant'));
            $applicant->profile_Picture = $filename;
            $applicant->save();

            return redirect()->back()->with('success', 'Profile Picture uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload Profile Picture.');
    }
}
