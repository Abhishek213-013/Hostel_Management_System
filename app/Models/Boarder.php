<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boarder extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'name',
        'gender',
        'phone',
        'address',
        'note',
        'created_by',
        'created_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function admission()
    {
        return $this->hasOneThrough(Admission::class, Invoice::class, 'id', 'invoice_id', 'invoice_id', 'id');
    }

    public function bed()
    {
        return $this->hasOneThrough(Bed::class, Admission::class, 'invoice_id', 'id', 'invoice_id', 'bed_id');
    }
}