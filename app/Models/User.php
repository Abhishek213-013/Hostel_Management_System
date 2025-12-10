<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role_id',
        'branch_id', // Add this
        'created_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    // Add branch relationship
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Existing relationships
    public function branches()
    {
        return $this->hasMany(Branch::class, 'created_id');
    }

    public function floors()
    {
        return $this->hasMany(Floor::class, 'created_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'created_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'created_id');
    }

    public function beds()
    {
        return $this->hasMany(Bed::class, 'created_id');
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class, 'created_id');
    }

    public function approvedAdmissions()
    {
        return $this->hasMany(Admission::class, 'approved_by_user');
    }

    public function boarders()
    {
        return $this->hasMany(Boarder::class, 'created_id');
    }

    public function createdBoarders()
    {
        return $this->hasMany(Boarder::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'created_id');
    }

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class, 'created_id');
    }

    public function inventoryFloors()
    {
        return $this->hasMany(InventoryFloor::class, 'created_id');
    }
}


