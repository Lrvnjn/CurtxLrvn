<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCred;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = UserCred::all();

        // Pass the users to the 'users' view
        return view('admin.users', compact('users'));
    }
    public function destroy($id)
    {
        $users = UserCred::findOrFail($id);
        $users->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $user = UserCred::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
            'municipality' => 'required',
            'status' => 'required',
        ]);

        $user->update($validated);

        return response()->json(['message' => 'User updated successfully']);
    }
}
