@extends('admin.layouts.admin')

@section('title', 'Users')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage Staff Users</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-ek-primary btn-sm"><i class="bi bi-plus-lg"></i> Add User</a>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($users as $u)
                        <tr>
                            <td>{{ $u->name }} @if($u->id === auth()->id()) <span class="badge bg-secondary">You</span> @endif</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td class="text-capitalize">{{ $u->role }}</td>
                            <td>
                                @if ($u->is_active)
                                    <span class="badge badge-confirmed">Active</span>
                                @else
                                    <span class="badge badge-cancelled">Inactive</span>
                                @endif
                                @if ($u->must_change_password)
                                    <span class="badge badge-pending">Must change password</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                @if ($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No users yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>

@endsection
