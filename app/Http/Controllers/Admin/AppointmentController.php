<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Appointment::with(['doctor', 'department'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date('date'));
        }

        $appointments = $query->paginate(15)->withQueryString();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment): View
    {
        $appointment->load(['doctor', 'department']);

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Receptionist confirms, reschedules, or cancels an appointment.
     */
    public function updateStatus(Request $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,rescheduled,rejected,cancelled'],
            'appointment_date' => ['required_if:status,rescheduled', 'nullable', 'date'],
            'appointment_time' => ['required_if:status,rescheduled', 'nullable'],
        ]);

        $appointment->status = $validated['status'];

        if ($validated['status'] === 'rescheduled') {
            $appointment->appointment_date = $validated['appointment_date'];
            $appointment->appointment_time = $validated['appointment_time'];
        }

        $appointment->save();

        ActivityLog::log('updated_appointment_status', $appointment, "Set appointment #{$appointment->id} to {$validated['status']}");

        // TODO (optional): trigger SMS/Email notification to the patient here.

        return back()->with('success', 'Hali ya appointment imesasishwa. / Appointment status updated.');
    }
}
