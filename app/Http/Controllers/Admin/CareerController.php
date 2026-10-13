<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::latest()->paginate(10);

        return view('admin.careers.index', compact('careers'));
    }

    public function create(): View
    {
        return view('admin.careers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $career = Career::create($validated);

        ActivityLog::log('created_career', $career, "Posted job: {$career->title}");

        return redirect()->route('admin.careers.index')->with('success', 'Nafasi ya kazi imeongezwa. / Job posted.');
    }

    public function edit(Career $career): View
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career): RedirectResponse
    {
        $validated = $this->validated($request);

        $career->update($validated);

        ActivityLog::log('updated_career', $career, "Updated job: {$career->title}");

        return redirect()->route('admin.careers.index')->with('success', 'Nafasi ya kazi imesasishwa. / Job updated.');
    }

    public function destroy(Career $career): RedirectResponse
    {
        $title = $career->title;
        $career->delete();

        ActivityLog::log('deleted_career', null, "Deleted job: {$title}");

        return back()->with('success', 'Nafasi ya kazi imeondolewa. / Job removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'department' => ['nullable', 'string', 'max:150'],
            'employment_type' => ['required', 'in:full_time,part_time,contract,internship'],
            'description' => ['required', 'string', 'max:3000'],
            'requirements' => ['nullable', 'string', 'max:3000'],
            'deadline' => ['nullable', 'date'],
            'is_open' => ['nullable', 'boolean'],
        ]);

        $validated['is_open'] = $request->boolean('is_open');

        return $validated;
    }
}
