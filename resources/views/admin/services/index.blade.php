@extends('admin.layouts.admin')

@section('title', 'Services')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage Services</h5>
        <a href="{{ route('admin.services.create') }}" class="btn btn-ek-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Service</a>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Icon</th><th>Name</th><th>Short Description</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td><i class="bi {{ $service->icon }} fs-4 text-primary"></i></td>
                            <td>{{ $service->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($service->short_desc, 60) }}</td>
                            <td>
                                @if ($service->is_active)
                                    <span class="badge badge-confirmed">Active</span>
                                @else
                                    <span class="badge badge-cancelled">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">No services yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $services->links() }}
    </div>

@endsection
