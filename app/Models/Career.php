<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title', 'department', 'employment_type', 'description',
        'requirements', 'deadline', 'is_open',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'deadline' => 'date',
    ];

    public function scopeOpen($query)
    {
        return $query->where('is_open', true);
    }
}
