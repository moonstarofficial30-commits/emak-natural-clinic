@extends('admin.layouts.admin')

@section('title', 'Add Specialist')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Add New Specialist</h5>
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.doctors._form')
        </form>
    </div>
@endsection
