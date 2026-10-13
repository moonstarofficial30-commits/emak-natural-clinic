<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $news->title ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Category</label>
        <select name="category" class="form-select" required>
            @php $cat = old('category', $news->category ?? 'health_tip'); @endphp
            <option value="health_tip" {{ $cat=='health_tip'?'selected':'' }}>Health Tip</option>
            <option value="event" {{ $cat=='event'?'selected':'' }}>Event</option>
            <option value="vaccination_campaign" {{ $cat=='vaccination_campaign'?'selected':'' }}>Vaccination Campaign</option>
            <option value="new_service" {{ $cat=='new_service'?'selected':'' }}>New Service</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Excerpt <span class="text-muted small">(short summary shown on cards)</span></label>
        <input type="text" name="excerpt" class="form-control" maxlength="300" value="{{ old('excerpt', $news->excerpt ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Content</label>
        <textarea name="content" rows="8" class="form-control" required>{{ old('content', $news->content ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Cover Image</label>
        <input type="file" name="cover_image" class="form-control" accept="image/*">
        @if (! empty($news->cover_image))
            <img src="{{ asset('storage/'.$news->cover_image) }}" class="mt-2 rounded" style="height:60px;">
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label">Publish Date</label>
        <input type="date" name="published_at" class="form-control" value="{{ old('published_at', isset($news->published_at) ? $news->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="is_published" value="1" class="form-check-input" id="isPublished"
                   {{ old('is_published', $news->is_published ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isPublished">Published</label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Save</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
