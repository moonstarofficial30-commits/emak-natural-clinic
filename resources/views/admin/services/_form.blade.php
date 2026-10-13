<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Service Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $service->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Icon <span class="text-muted small">(Bootstrap Icons class, e.g. bi-heart-pulse)</span></label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? 'bi-heart-pulse') }}" required>
        <div class="form-text">Browse icons at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></div>
    </div>
    <div class="col-12">
        <label class="form-label">Short Description <span class="text-muted small">(shown on cards)</span></label>
        <input type="text" name="short_desc" class="form-control" value="{{ old('short_desc', $service->short_desc ?? '') }}" required maxlength="255">
    </div>
    <div class="col-12">
        <label class="form-label">Full Description <span class="text-muted small">(shown on service detail page)</span></label>
        <textarea name="description" rows="5" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if (! empty($service->image))
            <img src="{{ asset('storage/'.$service->image) }}" class="mt-2 rounded" style="height:60px;">
        @endif
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                   {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Active (visible on website)</label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Save</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
