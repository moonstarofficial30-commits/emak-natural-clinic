<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function create(): View
    {
        $departments = Department::orderBy('name')->get();
        $doctors = Doctor::active()->orderBy('name')->get();

        return view('appointment', compact('departments', 'doctors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name'         => ['required', 'string', 'max:120'],
            'phone'             => ['required', 'string', 'max:30'],
            'email'             => ['nullable', 'email', 'max:150'],
            'gender'            => ['required', 'in:Male,Female'],
            'age'               => ['required', 'integer', 'min:0', 'max:120'],
            'department_id'     => ['nullable', 'exists:departments,id'],
            'doctor_id'         => ['nullable', 'exists:doctors,id'],
            'appointment_date'  => ['required', 'date', 'after_or_equal:today'],
            'appointment_time'  => ['required'],
            'message'           => ['nullable', 'string', 'max:1000'],
        ]);

        $validated['status'] = 'pending';

        Appointment::create($validated);

        // TODO (optional): send SMS/Email confirmation to the patient here,
        // and notify the receptionist dashboard in real time.

        return redirect()
            ->route('appointment.create')
            ->with('success', __('messages.appointment_success'));
    }
}
