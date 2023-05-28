<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Employer;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();

            // Store the uploaded logo in the storage/app/public directory
            Storage::disk('public')->put($filename, file_get_contents($logo));

            // Update the employer's logo in the database
            $employer = Employer::find(session('LoggedEmployer'));
            $employer->logo = $filename;
            $employer->save();

            return redirect()->back()->with('success', 'Logo uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload logo.');
    }
    public function index()
    {
        $employers = Employer::all();

        return view('employer.companies', compact('employers'));
    }

    public function showLoginForm()
    {
        return view('auth.employer.login');
    }

    public function login(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:16'
        ]);

        $employer = Employer::where('email', $request->email)->first();

        if (!$employer) {
            return back()->with('fail', 'We do not recognize your email address');
        } else {
            //check password
            if (Hash::check($request->password, $employer->password)) {
                $request->session()->put('LoggedEmployer', $employer->id);
                return redirect()->route('layout.app');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.employer.register');
    }

    public function register(Request $request)
    {
        // Handle registration logic
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employers',
            'password' => 'required|min:5|max:16',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle the logo file upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('employer-logos', 'public');
        } else {
            $logoPath = null;
        }

        // Insert data into the database
        $employer = new Employer();
        $employer->company_name = $request->company_name;
        $employer->website = $request->website;
        $employer->name = $request->name;
        $employer->email = $request->email;
        $employer->password = Hash::make($request->password);
        $employer->logo = $logoPath; // Store the logo path in the 'logo' column
        $save = $employer->save();

        if ($save) {
            return Redirect::route('employer.login')->with('success', 'New user has been successfully registered. Please login to continue.');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }
    public function logout()
    {
        if (session()->has('LoggedEmployer' )) {
            session()->forget('LoggedEmployer');
        }

        return redirect('/');
    }
    public function dashboard()
    {
        // Get the logged-in employer's ID
        $employerId = session('LoggedEmployer');

        // Retrieve the employer and their posted jobs
        $employer = Employer::findOrFail($employerId);
        $jobs = $employer->jobs;

        return view('employer.dashboard', compact('employer', 'jobs'));
    }

}