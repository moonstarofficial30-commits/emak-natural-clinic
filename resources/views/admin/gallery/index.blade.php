@extends('admin.layouts.admin')

@section('title', 'Gallery')

@section('content')

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <h5 class="mb-3">Upload Image</h5>
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Title (optional)</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <option value="clinic">Clinic</option>
                        <option value="herbs">Herbal Remedies</option>
                        <option value="consultation">Consultation</option>
                        <option value="reception">Reception</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-ek-primary w-100"><i class="bi bi-upload"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="row g-3">
        @forelse ($images as $img)
            <div class="col-6 col-md-3">
                <div class="bg-white rounded-4 shadow-sm p-2">
                    <img src="{{ asset('storage/'.$img->image) }}" class="w-100 rounded-3 mb-2" style="height:140px;object-fit:cover;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark text-capitalize">{{ $img->category }}</span>
                        <form action="{{ route('admin.gallery.destroy', $img) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">No images uploaded yet.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $images->links() }}</div>

@endsection
