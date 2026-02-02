<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /* ===============================
        LIST USERS
    =============================== */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /* ===============================
        CREATE FORM
    =============================== */
    public function create()
    {
        return view('admin.users.create');
    }

    /* ===============================
        STORE USER
    =============================== */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:user,admin',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'dob'      => 'nullable|date',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
            'phone'    => $data['phone'] ?? null,
            'address'  => $data['address'] ?? null,
            'dob'      => $data['dob'] ?? null,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    /* ===============================
        SHOW USER DETAIL
    =============================== */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /* ===============================
        EDIT FORM
    =============================== */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /* ===============================
        UPDATE USER
    =============================== */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|in:user,admin',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'dob'      => 'nullable|date',
        ]);

        $updateData = [
            'name'    => $data['name'],
            'email'   => $data['email'],
            'role'    => $data['role'],
            'phone'   => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'dob'     => $data['dob'] ?? null,
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    /* ===============================
        DELETE USER
    =============================== */
    public function destroy(User $user)
    {
        // Không cho admin xoá chính mình
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}
