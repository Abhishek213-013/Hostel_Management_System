<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'payment_method',
        'payment_uid',
        'amount',
        'created_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}