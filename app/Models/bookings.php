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
        'id',
        'name',
    ];
}
