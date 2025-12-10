<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryFloor extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'name',
        'category',
        'quantity',
        'created_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function inventory()
    {
        return $this->belongsTo(InventoryItem::class);
    }
}