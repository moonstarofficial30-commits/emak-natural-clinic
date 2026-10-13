@extends('admin.layouts.admin')

@section('title', 'Add User')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4" style="max-width:600px;">
        <h5 class="mb-4">Add Staff User</h5>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="receptionist" {{ old('role')=='receptionist'?'selected':'' }}>Receptionist</option>
                        <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Administrator</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" minlength="8" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" minlength="8" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Create User</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
