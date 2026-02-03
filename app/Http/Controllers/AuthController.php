<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng'
        ]);
    }

    // REGISTER
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable',
            'avatar' => 'nullable|image|max:2048',
            'address' => 'nullable',
            'pincode' => 'nullable',
            'dob' => 'nullable|date',
            'password' => 'required|confirmed|min:6'
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')
                ->store('avatars', 'public');
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // Auto-login newly registered user
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Welcome! Your account has been created.');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
