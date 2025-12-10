<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'bed_uid',
        'first_used_date',
        'is_usable',
        'invoice_id',
        'created_id',
    ];

    protected $casts = [
        'first_used_date' => 'date',
        'is_usable' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function currentAdmission()
    {
        return $this->admissions()->where('status', true)->latest()->first();
    }
}