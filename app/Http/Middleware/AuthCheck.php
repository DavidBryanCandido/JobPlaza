<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (
            !session()->has('LoggedEmployer') &&
            !session()->has('LoggedApplicant') &&
            (
                $request->path() != 'employer/login' && $request->path() != 'employer/register' &&
                $request->path() != 'applicant/login' && $request->path() != 'applicant/register'
            )
        ) {
            return redirect('applicant/register')->with('fail', 'You must be logged in');
        }

        if (
            (session()->has('LoggedEmployer') || session()->has('LoggedApplicant')) &&
            (
                $request->path() == 'employer/login' || $request->path() == 'employer/register' ||
                $request->path() == 'applicant/login' || $request->path() == 'applicant/register'
            )
        ) {
            return back();
        }

        $response = $next($request);

        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
