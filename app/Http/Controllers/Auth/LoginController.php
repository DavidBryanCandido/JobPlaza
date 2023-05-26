<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\Job;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function check(Request $request)
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
                $request->session()->put('LoggedUser', $employer->id);
                return redirect()->route('layout.app');
            } else {
                return back()->with('fail', 'Incorrect password');
            }
        }
    }

    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }

    public function dashboard()
    {
        // Get the logged-in employer's ID
        $employerId = session('LoggedUser');

        // Retrieve the employer and their posted jobs
        $employer = Employer::findOrFail($employerId);
        $jobs = $employer->jobs;

        return view('employer.dashboard', compact('employer', 'jobs'));
    }

}
