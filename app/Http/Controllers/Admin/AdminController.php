<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalRooms' => Room::count(),
            'todayBookings' => Booking::whereDate('check_in', today())->count(),
            'availableRooms' => Room::where('status', 'available')->count(),
            'totalUsers' => User::count(),
            'latestBookings' => Booking::latest()->take(5)->get(),
        ]);
    }
}
