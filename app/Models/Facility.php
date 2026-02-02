<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];
    protected $appends = ['icon_url'];
    public function getIconUrlAttribute()
    {
        return asset('icons/' . $this->icon);
    }
    public function rooms()
    {
        return $this->belongsToMany(
            Facility::class,
            'facility_room',
            'room_id',
            'facility_id'
        );
    }
}
