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
            'roomCount'    => Room::count(),
            'bookingCount' => Booking::count(),
            'userCount'    => User::count(),
        ]);
    }
}
