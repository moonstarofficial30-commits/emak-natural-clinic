<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = Gallery::latest()->paginate(16);

        return view('admin.gallery.index', compact('images'));
    }

    public function create(): View
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:150'],
            'category' => ['required', 'in:clinic,herbs,consultation,reception,other'],
            'image' => ['required', 'image', 'max:4096'],
        ]);

        $validated['image'] = $request->file('image')->store('gallery', 'public');

        $item = Gallery::create($validated);

        ActivityLog::log('uploaded_gallery_image', $item, 'Uploaded a gallery image');

        return back()->with('success', 'Picha imepakiwa. / Image uploaded.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        ActivityLog::log('deleted_gallery_image', null, 'Deleted a gallery image');

        return back()->with('success', 'Picha imeondolewa. / Image removed.');
    }
}
