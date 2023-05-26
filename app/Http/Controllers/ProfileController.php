<?php

namespace App\Http\Controllers;
use App\Models\Employer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        // Get the logged-in employer's ID
        $employerId = session('LoggedUser');

        // Retrieve the employer data
        $employer = Employer::findOrFail($employerId);

        return view('employer.profile', compact('employer'));
    }
}
