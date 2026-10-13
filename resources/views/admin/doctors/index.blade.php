@extends('admin.layouts.admin')

@section('title', 'Specialists')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage Specialists</h5>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-ek-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Specialist</a>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Specialization</th><th>Department</th><th>Experience</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>{{ $doctor->department?->name ?? '—' }}</td>
                            <td>{{ $doctor->experience_years }} yrs</td>
                            <td>
                                @if ($doctor->is_active)
                                    <span class="badge badge-confirmed">Active</span>
                                @else
                                    <span class="badge badge-cancelled">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this doctor?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No doctors yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $doctors->links() }}
    </div>

@endsection
