<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Placeholder model — the full Appointment booking flow
 * (form validation, receptionist confirmation, notifications)
 * is planned for Phase 3 of this project.
 */
class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'phone', 'email', 'gender', 'age',
        'department_id', 'doctor_id', 'appointment_date',
        'appointment_time', 'message', 'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
