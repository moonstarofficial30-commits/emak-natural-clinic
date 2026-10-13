@extends('admin.layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4" style="max-width:600px;">
        <h5 class="mb-4">Edit User — {{ $user->name }}</h5>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                        <option value="receptionist" {{ old('role', $user->role)=='receptionist'?'selected':'' }}>Receptionist</option>
                        <option value="admin" {{ old('role', $user->role)=='admin'?'selected':'' }}>Administrator</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                               {{ old('is_active', $user->is_active) ? 'checked' : '' }} {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">New Password <span class="text-muted small">(optional)</span></label>
                    <input type="password" name="password" class="form-control" minlength="8">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" minlength="8">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Save</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
