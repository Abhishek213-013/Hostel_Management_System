<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_uid',
        'invoice_date',
        'invoice_effective_date',
        'total',
        'discount',
        'status',
        'created_id',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'invoice_effective_date' => 'date',
        'total' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function boarders()
    {
        return $this->hasMany(Boarder::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public function getBalanceAttribute()
    {
        $paid = $this->payments()->sum('amount');
        return $this->total - $this->discount - $paid;
    }

    public function getIsPaidAttribute()
    {
        return $this->balance <= 0;
    }
}