<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function Index()
    {
        $users = User::with(['order'])->latest()->get();
        return response()->json($users);
    }

    public function update(Request $request, User $user)
    {
        $fields=$request->validate([
            'role' => 'required|in:customer,admin,editor',
            'name' => 'string'
        ]);
        $user->update($fields);
        return response()->json([
            'message'=> 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        if (auth()->id === $user->id) {
            return response()->json(['message' => 'You cannot delete your own admin account.'], 403);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
