<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonMainType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'common_maintype_info';

    protected $fillable = [
        'name',
        'slug',
        'position',
        'status',
        'description',
        'created_by',
        'last_modified_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'position' => 'integer',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lastModifiedBy()
    {
        return $this->belongsTo(User::class, 'last_modified_by');
    }

    public function types()
    {
        return $this->hasMany(CommonType::class, 'type_id');
    }

    public function activeTypes()
    {
        return $this->types()->where('status', true);
    }

    // Auto-generate slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = \Str::slug($model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = \Str::slug($model->name);
            }
        });
    }
}