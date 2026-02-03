<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Update basic info
        $data = $request->only([
            'name',
            'phone',
            'address',
            'dob',
        ]);

        // Update password (if provided)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update avatar
        if ($request->hasFile('avatar')) {

            // Delete old avatar
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')
                ->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully');
    }
}
