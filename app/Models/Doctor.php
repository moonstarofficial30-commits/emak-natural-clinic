<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'photo',
        'bio',
        'experience_years',
        'working_days',   // stored as JSON array e.g. ["Mon","Tue","Wed"]
        'department_id',
        'is_active',
    ];

    protected $casts = [
        'working_days' => 'array',
        'is_active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Public URL of the photo, or a neutral placeholder. */
    public function getPhotoUrlAttribute(): string
    {
        return $this->photo ? asset('storage/'.$this->photo) : asset('images/person.svg');
    }
}
