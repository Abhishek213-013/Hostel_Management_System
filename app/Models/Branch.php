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

    // Add users relationship
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Add branch managers relationship (users with Branch Manager role)
    public function managers()
    {
        return $this->users()->whereHas('role', function($query) {
            $query->where('name', 'Branch Manager');
        });
    }
}