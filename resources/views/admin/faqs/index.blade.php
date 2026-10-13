@extends('admin.layouts.admin')

@section('title', 'FAQs')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Manage FAQs</h5>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-ek-primary btn-sm"><i class="bi bi-plus-lg"></i> Add FAQ</a>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>#</th><th>Question</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($faqs as $faq)
                        <tr>
                            <td>{{ $faq->sort_order }}</td>
                            <td>{{ $faq->question }}</td>
                            <td>
                                @if ($faq->is_active)
                                    <span class="badge badge-confirmed">Active</span>
                                @else
                                    <span class="badge badge-cancelled">Hidden</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this FAQ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">No FAQs yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $faqs->links() }}
    </div>

@endsection
