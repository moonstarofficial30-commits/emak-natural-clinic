@extends('admin.layouts.admin')

@section('title', 'Careers')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage Job Postings</h5>
        <a href="{{ route('admin.careers.create') }}" class="btn btn-ek-primary btn-sm"><i class="bi bi-plus-lg"></i> Post Job</a>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Title</th><th>Type</th><th>Deadline</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($careers as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td class="text-capitalize">{{ str_replace('_',' ',$job->employment_type) }}</td>
                            <td>{{ $job->deadline?->format('d M Y') ?? '—' }}</td>
                            <td>
                                @if ($job->is_open)
                                    <span class="badge badge-confirmed">Open</span>
                                @else
                                    <span class="badge badge-cancelled">Closed</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.careers.edit', $job) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.careers.destroy', $job) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this job posting?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">No job postings yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $careers->links() }}
    </div>

@endsection
