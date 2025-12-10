<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'floor_id',
        'room_number',
        'capacity',
        'created_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

    public function availableBeds()
    {
        return $this->beds()->where('is_usable', true)->whereNull('invoice_id');
    }

    public function occupiedBeds()
    {
        return $this->beds()->whereNotNull('invoice_id');
    }
}