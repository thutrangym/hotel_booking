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
        'total_rooms',
        'available_rooms',
        'status',
        'facilities',
        'img',
    ];
    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facility', 'room_id', 'facility_id');
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
