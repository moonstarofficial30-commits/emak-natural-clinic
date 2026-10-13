@extends('admin.layouts.admin')

@section('title', 'Settings')

@section('content')

    @if ($user->must_change_password)
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Kwa usalama wa mfumo, tafadhali badilisha <strong>username na password ya default</strong> kabla ya kuendelea.
            <br>For security, please change the <strong>default username and password</strong> before continuing.
        </div>
    @endif

    <div class="row g-4">
        {{-- ACCOUNT SETTINGS: username & password change (all roles) --}}
        <div class="col-lg-6">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <h5 class="mb-3"><i class="bi bi-person-gear"></i> Account Settings</h5>
                <p class="text-muted small">Badilisha jina lako la mtumiaji (username) na password hapa. / Change your username and password here.</p>

                <form action="{{ route('admin.settings.account') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">New Password <span class="text-muted small">(leave blank to keep current password)</span></label>
                        <input type="password" name="password" class="form-control" minlength="8">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" minlength="8">
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="form-label">Current Password <span class="text-danger">*</span></label>
                        <input type="password" name="current_password" class="form-control" required>
                        <div class="form-text">Required to confirm any change to your account.</div>
                    </div>

                    <button type="submit" class="btn btn-ek-primary">
                        <i class="bi bi-save"></i> Save Account Settings
                    </button>
                </form>
            </div>
        </div>

        {{-- SITE SETTINGS: admin only --}}
        @if ($user->isAdmin())
            <div class="col-lg-6">
                <div class="bg-white rounded-4 shadow-sm p-4">
                    <h5 class="mb-3"><i class="bi bi-flower2"></i> Clinic Site Settings</h5>
                    <p class="text-muted small">Taarifa hizi zinaonekana kwenye website ya wagonjwa. / This info appears on the public website.</p>

                    <form action="{{ route('admin.settings.site') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="hospital_phone" class="form-control" value="{{ old('hospital_phone', $siteSettings['hospital_phone']) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="hospital_email" class="form-control" value="{{ old('hospital_email', $siteSettings['hospital_email']) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="hospital_address" class="form-control" value="{{ old('hospital_address', $siteSettings['hospital_address']) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">WhatsApp Number (with country code, no +)</label>
                            <input type="text" name="hospital_whatsapp" class="form-control" value="{{ old('hospital_whatsapp', $siteSettings['hospital_whatsapp']) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Emergency Number</label>
                            <input type="text" name="hospital_emergency" class="form-control" value="{{ old('hospital_emergency', $siteSettings['hospital_emergency']) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Google Map Embed URL</label>
                            <input type="text" name="hospital_map_embed_url" class="form-control" placeholder="https://www.google.com/maps/embed?..." value="{{ old('hospital_map_embed_url', $siteSettings['hospital_map_embed_url']) }}">
                        </div>

                        <button type="submit" class="btn btn-ek-secondary">
                            <i class="bi bi-save"></i> Save Site Settings
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

@endsection
