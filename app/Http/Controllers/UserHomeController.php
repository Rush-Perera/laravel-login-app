<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserHomeController extends Controller
{
    public function getUserDetails($userId)
    {
        $user = User::find($userId);

        // Return the user details as JSON
        return response()->json($user);
    }

    public function deactivateUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['is_active' => false]);

            return response()->json(['message' => 'User deactivated successfully']);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
    public function activateUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update(['is_active' => true]);

            return response()->json(['message' => 'User activated successfully']);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function updateUser(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'user_type' => 'required|in:user,admin,superadmin',
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update user data
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
        ]);

        // You can return the updated user data if needed
        return response()->json(['message' => 'User updated successfully', 'updatedUser' => $user]);
    }

}
