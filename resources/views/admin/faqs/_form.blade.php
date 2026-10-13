<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Question</label>
        <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Answer</label>
        <textarea name="answer" rows="5" class="form-control" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                   {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Active (visible on website)</label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-ek-primary"><i class="bi bi-save"></i> Save</button>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</div>
