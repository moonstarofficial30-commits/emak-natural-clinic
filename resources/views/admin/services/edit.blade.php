@extends('admin.layouts.admin')

@section('title', 'Edit Service')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Edit Service — {{ $service->name }}</h5>
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.services._form')
        </form>
    </div>
@endsection
