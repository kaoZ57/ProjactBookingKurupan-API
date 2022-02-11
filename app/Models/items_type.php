<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items_type extends Model
{
    use HasFactory;
    public $table = 'items_types';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
    ];

    public function item()
    {
        return $this->hasMany(items::class);
    }
}
