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
        'dob', // Add this
        'address',
        'role_id',
        'branch_id',
        'created_id',
        'profile_picture', // Add this
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

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    // Existing relationships...
    
    // Get profile picture URL
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture) {
            return asset('storage/profile-pictures/' . $this->profile_picture);
        }
        return $this->getDefaultProfilePicture();
    }
    
    protected function getDefaultProfilePicture()
    {
        // Create initials from name
        $initials = $this->getInitialsFromName($this->name);
        return "https://ui-avatars.com/api/?name={$initials}&background=3b82f6&color=ffffff&bold=true&size=128";
    }
    
    protected function getInitialsFromName($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return substr($initials, 0, 2);
    }
    
    // Append the URL to the model
    protected $appends = ['profile_picture_url'];
}