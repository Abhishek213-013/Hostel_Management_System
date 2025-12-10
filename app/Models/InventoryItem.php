<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_item_id',
        'inventory_id',
        'used_by',
        'used_at',
        'status',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function invoiceItem()
    {
        return $this->belongsTo(InvoiceItem::class);
    }

    public function parentInventory()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_id');
    }

    public function childInventories()
    {
        return $this->hasMany(InventoryItem::class, 'inventory_id');
    }

    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by');
    }

    public function inventoryFloors()
    {
        return $this->hasMany(InventoryFloor::class);
    }
}