@extends('admin.layouts.admin')

@section('title', 'Activity Logs')

@section('content')

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>User</th><th>Action</th><th>Description</th><th>IP Address</th><th>When</th></tr></thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->user?->name ?? 'System' }}</td>
                            <td><span class="badge bg-light text-dark">{{ str_replace('_',' ',$log->action) }}</span></td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->ip_address }}</td>
                            <td>{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">No activity recorded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $logs->links() }}
    </div>

@endsection
