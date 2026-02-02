<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    // LIST
    public function index()
    {
        $rooms = Room::with(['images', 'facilities'])
            ->latest()
            ->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    // FORM CREATE
    public function create()
    {
        $facilities = Facility::all();
        return view('admin.rooms.create', compact('facilities'));
    }

    // STORE
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'size'        => 'nullable|integer',
            'capacity'    => 'nullable|integer',
            'description' => 'nullable|string',

            'facilities'   => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',

            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Create room
        $room = Room::create($data);

        // Sync facilities
        if (!empty($data['facilities'])) {
            $room->facilities()->sync($data['facilities']);
        }

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');

                $room->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room created successfully');
    }

    // FORM EDIT
    public function edit(Room $room)
    {
        $room->load(['facilities', 'images']);
        $facilities = Facility::all();

        return view('admin.rooms.edit', compact('room', 'facilities'));
    }

    // UPDATE
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'size'        => 'nullable|integer',
            'capacity'    => 'nullable|integer',
            'description' => 'nullable|string',

            'total_rooms'      => 'required|integer|min:0',
            'available_rooms'  => 'required|integer|min:0',
            'status'           => 'required|in:available,hidden',

            'facilities'   => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',

            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        if ($data['available_rooms'] > $data['total_rooms']) {
            return back()
                ->withErrors(['available_rooms' => 'Available rooms cannot exceed total rooms'])
                ->withInput();
        }

        // Update room info
        $room->update([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'size'        => $data['size'] ?? null,
            'capacity'    => $data['capacity'] ?? null,
            'description' => $data['description'] ?? null,
            'total_rooms'     => $data['total_rooms'],
            'available_rooms' => $data['available_rooms'],
            'status'          => $data['status'],
        ]);

        // Sync facilities
        $room->facilities()->sync($data['facilities'] ?? []);

        // Add new images (không xoá ảnh cũ)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');

                $room->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room updated successfully');
    }

    // DELETE
    public function destroy(Room $room)
    {
        // Delete images from storage
        foreach ($room->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully');
    }
    // SHOW
    public function show(Room $room)
    {
        $room->load(['facilities', 'images']);

        return view('admin.rooms.show', compact('room'));
    }
}
