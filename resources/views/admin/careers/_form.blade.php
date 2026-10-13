<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Job Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $career->title ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Department</label>
        <input type="text" name="department" class="form-control" value="{{ old('department', $career->department ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Employment Type</label>
        @php $type = old('employment_type', $career->employment_type ?? 'full_time'); @endphp
        <select name="employment_type" class="form-select" required>
            <option value="full_time" {{ $type=='full_time'?'selected':'' }}>Full Time</option>
            <option value="part_time" {{ $type=='part_time'?'selected':'' }}>Part Time</option>
            <option value="contract" {{ $type=='contract'?'selected':'' }}>Contract</option>
            <option value="internship" {{ $type=='internship'?'selected':'' }}>Internship</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Application Deadline</label>
        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', isset($career->deadline) ? $career->deadline->format('Y-m-d') : '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control" required>{{ old('description', $career->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Requirements</label>
        <textarea name="requirements" rows="4" class="form-control">{{ old('requirements', $career->requirements ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" name="is_open" value="1" class="form-check-input" id="isOpen"
                   {{ old('is_open', $career->is_open ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isOpen">Open (accepting applications)</label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Save</button>
        <a href="{{ route('admin.careers.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
