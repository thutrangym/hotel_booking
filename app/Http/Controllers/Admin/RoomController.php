<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('images')->latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'description'     => 'nullable|string',
            'total_rooms'     => 'required|integer',
            'available_rooms' => 'required|integer',
            'status'          => 'required|boolean',
        ]);

        Room::create($data);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Tạo phòng thành công');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'description'     => 'nullable|string',
            'total_rooms'     => 'required|integer',
            'available_rooms' => 'required|integer',
            'status'          => 'required|boolean',
        ]);

        $room->update($data);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Cập nhật phòng thành công');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Đã xoá phòng');
    }
}
