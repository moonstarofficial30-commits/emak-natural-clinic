@extends('admin.layouts.admin')

@section('title', 'News')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage News & Health Tips</h5>
        <a href="{{ route('admin.news.create') }}" class="btn btn-ek-primary btn-sm"><i class="bi bi-plus-lg"></i> Add News</a>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Title</th><th>Category</th><th>Author</th><th>Published</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td class="text-capitalize">{{ str_replace('_',' ',$item->category) }}</td>
                            <td>{{ $item->author?->name ?? '—' }}</td>
                            <td>{{ $item->published_at?->format('d M Y') }}</td>
                            <td>
                                @if ($item->is_published)
                                    <span class="badge badge-confirmed">Published</span>
                                @else
                                    <span class="badge badge-pending">Draft</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this news item?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No news yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $news->links() }}
    </div>

@endsection
