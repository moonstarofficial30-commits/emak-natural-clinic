<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('sort_order')->paginate(15);

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $faq = Faq::create($validated);

        ActivityLog::log('created_faq', $faq, 'Added a FAQ');

        return redirect()->route('admin.faqs.index')->with('success', 'Swali limeongezwa. / FAQ added.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $this->validated($request);

        $faq->update($validated);

        ActivityLog::log('updated_faq', $faq, 'Updated a FAQ');

        return redirect()->route('admin.faqs.index')->with('success', 'Swali limesasishwa. / FAQ updated.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        ActivityLog::log('deleted_faq', null, 'Deleted a FAQ');

        return back()->with('success', 'Swali limeondolewa. / FAQ removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
