<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'bed_id',
        'start_date',
        'expected_leave_date',
        'admission_floor_location',
        'status',
        'approved_by_user',
        'created_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'expected_leave_date' => 'date',
        'status' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_user');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function boarder()
    {
        return $this->hasOneThrough(Boarder::class, Invoice::class, 'id', 'invoice_id', 'invoice_id', 'id');
    }
}