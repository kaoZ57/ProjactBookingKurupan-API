<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items_type extends Model
{
    use HasFactory;
    public $table = 'items_type';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
    ];
}
