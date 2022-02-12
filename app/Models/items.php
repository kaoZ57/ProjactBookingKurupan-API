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
        'quantity',
    ];

    public function itemsType()
    {
        return $this->belongsTo(items_type::class, 'item_type_id', 'id');
    }

    public function note_item()
    {
        return $this->belongsTo(note_item::class, 'id', 'item_id');
    }
}
