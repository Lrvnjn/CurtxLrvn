<?php

use App\Http\Controllers\UserRegistrationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ReportController;  
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManageActivitiesController;
use App\Http\Controllers\GenerateController;  
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// STORE USERS
Route::post('/users/store', [UserRegistrationController::class, 'store'])->name('users.store');

// PAGES ADMIN
Route::get('/activities', [ActivityController::class, 'index'])->name('activities');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/generateqr', [QRCodeController::class, 'index'])->name('generateqr');
Route::get('/admin/manage/{id}', [ManageActivitiesController::class, 'show'])->name('admin.manage');

// PAGES ALL DASHBOARDS
Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'president':
                return redirect()->route('president.dashboard');
            default:
                return view('index'); // fallback view if role is not matched
        }
    }

    return view('index'); // user not logged in
});

// PAGES MUNICIPAL PRES
Route::get('/events', [EventsController::class, 'mun'])->name('events');
Route::get('/generate', [GenerateController::class, 'mun'])->name('generate');
Route::get('/overview', [OverviewController::class, 'mun'])->name('overview');
Route::get('/president/manage/{id}', [ManageActivitiesController::class, 'showw'])->name('president.manage');

// OTHER
Route::get('/', function () {
    return view('index');
});

use App\Http\Controllers\AuthController;

// LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// ADMIN 
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard'); 
// STAFF 
Route::get('/staff/dashboard', function () {
    return view('staff.dashboard');
})->name('staff.dashboard'); 
// PRESIDENT 
Route::get('/president/dashboard', function () {
    return view('president.dashboard');
})->name('president.dashboard'); 

// ADMIN ACTS
Route::get('/admin/activities', function () {
    return view('activities');
})->name('activities'); 

// PRESIDENT ACTS
Route::get('/president/events', function () {
    return view('events');
})->name('events');

// LOGOUT
Route::post('logout', function() {
    Auth::logout();
    return view('index');
})->name('logout');

// Delete User
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Delete Activity
Route::delete('/activities/{id}', [ActivityController::class, 'destroy'])->name('activities.destroy');

// Edit Activity
Route::put('/activities/{id}', [ActivityController::class, 'update'])->name('activities.update');

// Edit User 
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Activity Routes
Route::post('/activities/store', [ActivityController::class, 'store'])->name('activities.store');

// Status Update
Route::post('/admin/{id}/update-status', [App\Http\Controllers\ActivityController::class, 'updateStatus'])->name('activities.updateStatus');
Route::put('/activities/{id}/status', [ActivityController::class, 'updateStatus']);

// Manage Activity
Route::put('/activities/{id}', [ActivityController::class, 'update'])->name('activities.update');
Route::get('/activities/manage/{id}', [ActivityController::class, 'manage'])->name('activities.manage');

// ERROR acts
Route::get('/president/activities', [ActivityController::class, 'index'])->name('president.activities');
