<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::latest()->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service = Service::create($validated);

        ActivityLog::log('created_service', $service, "Added service: {$service->name}");

        return redirect()->route('admin.services.index')->with('success', 'Huduma imeongezwa. / Service added.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        ActivityLog::log('updated_service', $service, "Updated service: {$service->name}");

        return redirect()->route('admin.services.index')->with('success', 'Huduma imesasishwa. / Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $name = $service->name;
        $service->delete();

        ActivityLog::log('deleted_service', null, "Deleted service: {$name}");

        return back()->with('success', 'Huduma imeondolewa. / Service removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'icon' => ['required', 'string', 'max:60'],
            'short_desc' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:3000'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        unset($validated['image']);

        return $validated;
    }
}
