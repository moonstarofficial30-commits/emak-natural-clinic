<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function index(): View
    {
        $doctors = Doctor::with('department')->latest()->paginate(10);

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create(): View
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.doctors.create', compact('departments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor = Doctor::create($validated);

        ActivityLog::log('created_doctor', $doctor, "Added doctor: {$doctor->name}");

        return redirect()->route('admin.doctors.index')->with('success', 'Daktari ameongezwa. / Doctor added.');
    }

    public function edit(Doctor $doctor): View
    {
        $departments = Department::orderBy('name')->get();

        return view('admin.doctors.edit', compact('doctor', 'departments'));
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($validated);

        ActivityLog::log('updated_doctor', $doctor, "Updated doctor: {$doctor->name}");

        return redirect()->route('admin.doctors.index')->with('success', 'Taarifa za daktari zimehifadhiwa. / Doctor updated.');
    }

    public function destroy(Doctor $doctor): RedirectResponse
    {
        $name = $doctor->name;
        $doctor->delete();

        ActivityLog::log('deleted_doctor', null, "Deleted doctor: {$name}");

        return back()->with('success', 'Daktari ameondolewa. / Doctor removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'specialization' => ['required', 'string', 'max:150'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:70'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'working_days' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        unset($validated['photo']); // handled separately (file upload)

        return $validated;
    }
}
