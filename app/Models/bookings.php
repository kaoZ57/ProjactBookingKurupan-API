<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    use HasFactory;
    use HasFactory;
    public $table = 'bookings';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'booking_item_id',
        'booking_status',
        'start_date',
        'end_date',
    ];
}
