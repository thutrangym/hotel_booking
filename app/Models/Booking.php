<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    const PAYMENT_UNPAID = 'unpaid';
    const PAYMENT_PAID = 'paid';
    const PAYMENT_FAILED = 'failed';

    protected $fillable = [
        'room_id',
        'user_id',
        'quantity',
        'guest_name',
        'phone',
        'note',
        'status',
        'payment_status',
        'refund_amount',
        'check_in',
        'check_out',
        'actual_check_out_date',
        'total_price',
    ];

    protected $casts = [
        'check_in'  => 'date',
        'check_out' => 'date',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
