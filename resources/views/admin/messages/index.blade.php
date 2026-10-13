@extends('admin.layouts.admin')

@section('title', 'Contact Messages')

@section('content')

    <div class="bg-white rounded-4 shadow-sm p-3">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Subject</th><th>Received</th><th>Status</th><th></th></tr></thead>
                <tbody>
                    @forelse ($messages as $m)
                        <tr class="{{ ! $m->is_read ? 'fw-semibold' : '' }}">
                            <td>{{ $m->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($m->subject, 50) }}</td>
                            <td>{{ $m->created_at->format('d M Y H:i') }}</td>
                            <td>
                                @if ($m->is_read)
                                    <span class="badge bg-light text-dark">Read</span>
                                @else
                                    <span class="badge bg-danger">New</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                                <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">No messages yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $messages->links() }}
    </div>

@endsection
