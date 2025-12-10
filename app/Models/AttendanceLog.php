<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'boarder_id',
        'attention',
        'note',
        'created_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function boarder()
    {
        return $this->belongsTo(Boarder::class);
    }
}