@php
    $workingDaysAll = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $selectedDays = old('working_days', $doctor->working_days ?? []);
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Specialization</label>
        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->specialization ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Department</label>
        <select name="department_id" class="form-select">
            <option value="">—</option>
            @foreach ($departments as $dept)
                <option value="{{ $dept->id }}" {{ old('department_id', $doctor->department_id ?? '') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Years of Experience</label>
        <input type="number" name="experience_years" min="0" max="70" class="form-control" value="{{ old('experience_years', $doctor->experience_years ?? 0) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Working Days</label>
        <div class="d-flex flex-wrap gap-3">
            @foreach ($workingDaysAll as $day)
                <div class="form-check">
                    <input type="checkbox" name="working_days[]" value="{{ $day }}" class="form-check-input"
                           id="day{{ $day }}" {{ in_array($day, $selectedDays ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="day{{ $day }}">{{ $day }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Bio</label>
        <textarea name="bio" rows="4" class="form-control">{{ old('bio', $doctor->bio ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Photo</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
        @if (! empty($doctor->photo))
            <img src="{{ asset('storage/'.$doctor->photo) }}" class="mt-2 rounded" style="height:60px;">
        @endif
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                   {{ old('is_active', $doctor->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Active (visible on website)</label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Save</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
