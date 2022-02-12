<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note_item extends Model
{
    use HasFactory;
    public $table = 'note_item';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'note',
        'item_id'
    ];
}
