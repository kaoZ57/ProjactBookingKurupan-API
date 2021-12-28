<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookings_item extends Model
{
    use HasFactory;
    public $table = 'bookings_item';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'booking_item_id',
        'item_id',
    ];
}
