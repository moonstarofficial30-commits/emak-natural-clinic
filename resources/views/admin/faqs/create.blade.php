@extends('admin.layouts.admin')

@section('title', 'Add FAQ')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Add FAQ</h5>
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            @include('admin.faqs._form')
        </form>
    </div>
@endsection
