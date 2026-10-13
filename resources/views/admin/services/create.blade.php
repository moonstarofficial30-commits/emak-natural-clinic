@extends('admin.layouts.admin')

@section('title', 'Add Service')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Add New Service</h5>
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form')
        </form>
    </div>
@endsection
