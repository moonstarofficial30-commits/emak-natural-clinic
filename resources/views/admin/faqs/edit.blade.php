@extends('admin.layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Edit FAQ</h5>
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.faqs._form')
        </form>
    </div>
@endsection
