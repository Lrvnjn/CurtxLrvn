<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserCred;

class UserRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user_creds,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'role' => 'required|string',
            'municipality' => 'required|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        UserCred::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'phone' => $request->phone,
            'role' => $request->role,
            'municipality' => $request->municipality,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'User registered successfully']);
    }

    // (Optional) Create an index method to list users for your view.
    public function index()
    {
        $users = UserCred::all();
        return view('admin.users', compact('users'));
    }
}
