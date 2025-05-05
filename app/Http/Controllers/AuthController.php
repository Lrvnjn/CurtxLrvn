<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminCred;
use App\Models\UserCred;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Try logging in as Admin
        $admin = AdminCred::where('username', $request->username)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'user' => $admin->username,
                'role' => 'admin'
            ]);
            return redirect()->route('admin.dashboard');
        }

        // Try logging in as Staff or President
        $user = UserCred::where('email', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $role = strtolower(trim($user->role));

            session([
                'user' => $user->email,
                'role' => $role,
            ]);

            if ($role === 'municipal president') {
                return redirect()->route('president.dashboard');
            } elseif ($role === 'inb staff') {
                return redirect()->route('staff.dashboard');
            }

            return back()->with('login_error', 'Invalid role assigned to user.');
        }

        return back()->with('login_error', 'Invalid credentials, Try Again!');
    }
}
