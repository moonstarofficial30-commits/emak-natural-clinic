@extends('admin.layouts.admin')

@section('title', 'Appointments')

@section('content')

    <div class="bg-white rounded-4 shadow-sm p-3 mb-3">
        <form class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All</option>
                    @foreach (['pending','confirmed','rescheduled','rejected','cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Date</label>
                <input type="date" name="date" class="form-control form-control-sm" value="{{ request('date') }}" onchange="this.form.submit()">
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Patient</th><th>Phone</th><th>Specialist</th><th>Date</th><th>Time</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($appointments as $a)
                        <tr>
                            <td>{{ $a->full_name }}</td>
                            <td>{{ $a->phone }}</td>
                            <td>{{ $a->doctor?->name ?? '—' }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($a->appointment_date)->format('d M Y') }}</td>
                            <td>{{ $a->appointment_time }}</td>
                            <td><span class="badge badge-{{ $a->status }} text-capitalize">{{ $a->status }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('admin.appointments.show', $a) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No appointments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $appointments->links() }}
    </div>

@endsection
