<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::latest()->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['slug'] = Str::slug($validated['title']).'-'.uniqid();
        $validated['author_id'] = Auth::id();

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $news = News::create($validated);

        ActivityLog::log('created_news', $news, "Published news: {$news->title}");

        return redirect()->route('admin.news.index')->with('success', 'Habari imechapishwa. / News published.');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $news->update($validated);

        ActivityLog::log('updated_news', $news, "Updated news: {$news->title}");

        return redirect()->route('admin.news.index')->with('success', 'Habari imesasishwa. / News updated.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $title = $news->title;
        $news->delete();

        ActivityLog::log('deleted_news', null, "Deleted news: {$title}");

        return back()->with('success', 'Habari imeondolewa. / News removed.');
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'category' => ['required', 'in:health_tip,event,vaccination_campaign,new_service'],
            'excerpt' => ['nullable', 'string', 'max:300'],
            'content' => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['published_at'] ?? now();
        unset($validated['cover_image']);

        return $validated;
    }
}
