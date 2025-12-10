<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'common_type_info';

    protected $fillable = [
        'type_id',
        'name',
        'slug',
        'position',
        'status',
        'metadata',
        'update_count',
        'created_by',
        'last_modified_by',
        'last_modified_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'position' => 'decimal:4',
        'metadata' => 'array',
        'last_modified_at' => 'datetime',
    ];

    public function mainType()
    {
        return $this->belongsTo(CommonMainType::class, 'type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lastModifiedBy()
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }

    // Auto-update last_modified_at and update_count
    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->last_modified_at = now();
            $model->update_count = $model->update_count + 1;
        });

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Str::slug($model->name);
            }
            // Set initial position based on ID if not set
            if (empty($model->position)) {
                $maxPosition = self::where('type_id', $model->type_id)->max('position');
                $model->position = $maxPosition ? $maxPosition + 1 : 1;
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = \Str::slug($model->name);
            }
        });
    }

    // Scope for active types
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for specific type
    public function scopeOfType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }

    // Get next position
    public static function getNextPosition($typeId)
    {
        $maxPosition = self::where('type_id', $typeId)->max('position');
        return $maxPosition ? $maxPosition + 1 : 1;
    }
}