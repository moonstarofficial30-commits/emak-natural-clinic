@extends('admin.layouts.admin')

@section('title', 'Edit Specialist')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Edit Specialist — {{ $doctor->name }}</h5>
        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.doctors._form')
        </form>
    </div>
@endsection
