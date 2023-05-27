<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function approve(Request $request, Application $application)
    {
        // Update the application status to "Approved"
        $application->status = 'Approved';
        $application->save();

        return redirect()->back()->with('success', 'Application approved successfully.');
    }

    public function deny(Request $request, Application $application)
    {
        // Update the application status to "Denied"
        $application->status = 'Denied';
        $application->save();

        return redirect()->back()->with('success', 'Application denied successfully.');
    }

    public function delete(Request $request, Application $application)
    {
        // Delete the application and remove the associated resume file
        $resumePath = $application->resume;
        $application->delete();
        Storage::delete($resumePath);

        return redirect()->back()->with('success', 'Application deleted successfully.');
    }
}
