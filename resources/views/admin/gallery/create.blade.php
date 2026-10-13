@extends('admin.layouts.admin')

@section('title', 'Upload Image')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Upload Gallery Image</h5>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Title (optional)</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="clinic">Clinic</option>
                        <option value="herbs">Herbal Remedies</option>
                        <option value="consultation">Consultation</option>
                        <option value="reception">Reception</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-ek-primary"><i class="bi bi-upload"></i> Upload</button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
