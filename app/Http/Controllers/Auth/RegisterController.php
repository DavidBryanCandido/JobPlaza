<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
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
            return Redirect::route('login')->with('success', 'New user has been successfully registered. Please login to continue.');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }
}