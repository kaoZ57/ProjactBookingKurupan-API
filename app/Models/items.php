<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;
    public $table = 'items';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'item_type_id',
        'description',
        'is_active',
    ];
}
