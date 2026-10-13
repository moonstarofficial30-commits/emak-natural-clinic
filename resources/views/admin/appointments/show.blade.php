@extends('admin.layouts.admin')

@section('title', 'Appointment Details')

@section('content')

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <h5 class="mb-3">Patient Details</h5>
                <table class="table table-borderless">
                    <tr><th>Name</th><td>{{ $appointment->full_name }}</td></tr>
                    <tr><th>Phone</th><td>{{ $appointment->phone }}</td></tr>
                    <tr><th>Email</th><td>{{ $appointment->email ?? '—' }}</td></tr>
                    <tr><th>Gender</th><td>{{ $appointment->gender ?? '—' }}</td></tr>
                    <tr><th>Age</th><td>{{ $appointment->age ?? '—' }}</td></tr>
                    <tr><th>Department</th><td>{{ $appointment->department?->name ?? '—' }}</td></tr>
                    <tr><th>Specialist</th><td>{{ $appointment->doctor?->name ?? '—' }}</td></tr>
                    <tr><th>Date</th><td>{{ \Illuminate\Support\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td></tr>
                    <tr><th>Time</th><td>{{ $appointment->appointment_time }}</td></tr>
                    <tr><th>Message</th><td>{{ $appointment->message ?? '—' }}</td></tr>
                    <tr><th>Status</th><td><span class="badge badge-{{ $appointment->status }} text-capitalize">{{ $appointment->status }}</span></td></tr>
                </table>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <h5 class="mb-3">Update Status</h5>
                <div class="d-flex gap-2 mb-4">
                    <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check2-circle"></i> Accept</button>
                    </form>
                    <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST" onsubmit="return confirm('Reject this appointment request?')">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-x-circle"></i> Reject</button>
                    </form>
                </div>
                <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="statusSelect" class="form-select" onchange="document.getElementById('rescheduleFields').style.display = this.value==='rescheduled' ? 'block' : 'none'">
                            @foreach (['pending','confirmed','rescheduled','rejected','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $appointment->status==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="rescheduleFields" style="display: {{ $appointment->status === 'rescheduled' ? 'block' : 'none' }};">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">New Date</label>
                                <input type="date" name="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">New Time</label>
                                <input type="time" name="appointment_time" class="form-control" value="{{ $appointment->appointment_time }}">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-ek-primary"><i class="bi bi-check2"></i> Update Status</button>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection
