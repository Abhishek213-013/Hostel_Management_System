<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'email',
        'phone',
        'address',
        'created_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function floors()
    {
        return $this->hasManyThrough(Floor::class, Room::class);
    }
}