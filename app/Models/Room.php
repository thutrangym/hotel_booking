<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Facility;
use App\Models\RoomImage;

class Room extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'size',
        'capacity',
        'status',
        'total_rooms',
        'available_rooms',
    ];

    // Append a convenient `image` attribute that returns the first image path
    protected $appends = ['image'];

    public function getImageAttribute()
    {
        $first = $this->images()->first();
        return $first ? $first->image_path : null;
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_room');
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
