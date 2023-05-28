<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicantController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show']);

// Route::get('auth/login', [LoginController::class, 'login'])->name('login');
// Route::post('auth/login', [LoginController::class, 'check'])->name('login.check');

// Route::get('register', [RegisterController::class, 'registerForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register'])->name('register.save');


// Applicants
Route::get('/applicant/login', [ApplicantController::class, 'showLoginForm'])->name('applicant.login');
Route::post('/applicant/login', [ApplicantController::class, 'login'])->name('applicant.login.check');
Route::get('/applicant/register', [ApplicantController::class, 'showRegistrationForm'])->name('applicant.register');
Route::post('/applicant/register', [ApplicantController::class, 'register'])->name('applicant.register.save');
Route::get('applicant/logout', [ApplicantController::class, 'logout'])->name('applicant.logout');

// Employers
Route::get('/employer/login', [EmployerController::class, 'showLoginForm'])->name('employer.login');
Route::post('/employer/login', [EmployerController::class, 'login'])->name('employer.login.check');
Route::get('/employer/register', [EmployerController::class, 'showRegistrationForm'])->name('employer.register');
Route::post('/employer/register', [EmployerController::class, 'register'])->name('employer.register.save');
Route::get('/employers', [EmployerController::class, 'index'])->name('employer.index');
Route::get('auth/logout', [EmployerController::class, 'logout'])->name('logout');



Route::group(['middleware'=>['AuthCheck']],function () {
    Route::get('/employer/dashboard', [LoginController::class, 'dashboard'])->name('employer.dashboard');
    Route::get('/employer/dashboard', [EmployerController::class, 'dashboard'])->name('layout.app');
    
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.app');
    Route::get('/applicant/profile', [ApplicantController::class, 'show'])->name('applicant.profile');
    Route::post('/applicant/upload-logo', [ApplicantController::class, 'uploadLogo'])->name('applicant.upload.logo');
    
    Route::get('/job/create', [JobController::class, 'showCreateForm'])->name('job.createForm'); // Add this line for rendering the job creation form
    Route::get('/jobs/{id}/apply', [JobController::class, 'applyForm'])->name('job.applyForm');
    
    Route::post('/jobs/{id}/apply', [JobController::class, 'apply'])->name('job.apply');
    Route::post('/job/create', [JobController::class, 'create'])->name('job.create'); // Add this line for storing the created job
    Route::get('/employer/profile', [ProfileController::class, 'show'])->name('employer.profile');
    Route::post('employer/upload-logo', [EmployerController::class, 'uploadLogo'])->name('upload.logo');
  

    Route::put('/jobs/{job}/edit-status', [JobController::class, 'editStatus'])->name('edit.job.status');
    Route::get('job/{id}/applicants', [JobController::class, 'viewApplicants'])->name('job.applicants');
    
    Route::post('/application/{application}/approve', [ApplicationController::class, 'approve'])->name('application.approve');
    Route::post('/application/{application}/deny', [ApplicationController::class, 'deny'])->name('application.deny');
    Route::delete('/application/{application}/delete', [ApplicationController::class, 'delete'])->name('application.delete');


    // Add other authenticated routes here
});
