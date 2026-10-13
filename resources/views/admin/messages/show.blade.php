@extends('admin.layouts.admin')

@section('title', 'Message Details')

@section('content')

    <div class="bg-white rounded-4 shadow-sm p-4" style="max-width:700px;">
        <table class="table table-borderless">
            <tr><th>Name</th><td>{{ $message->name }}</td></tr>
            <tr><th>Email</th><td>{{ $message->email }}</td></tr>
            <tr><th>Phone</th><td>{{ $message->phone ?? '—' }}</td></tr>
            <tr><th>Subject</th><td>{{ $message->subject }}</td></tr>
            <tr><th>Received</th><td>{{ $message->created_at->format('d M Y H:i') }}</td></tr>
        </table>
        <hr>
        <p>{{ $message->message }}</p>
        <a href="mailto:{{ $message->email }}" class="btn btn-ek-primary"><i class="bi bi-reply"></i> Reply via Email</a>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

@endsection
