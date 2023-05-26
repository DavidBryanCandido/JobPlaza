<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Employer;

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
            $employer = Employer::find(session('LoggedUser'));
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
}
