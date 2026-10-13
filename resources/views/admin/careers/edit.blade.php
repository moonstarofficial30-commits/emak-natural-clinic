@extends('admin.layouts.admin')

@section('title', 'Edit Job Posting')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Edit Job — {{ $career->title }}</h5>
        <form action="{{ route('admin.careers.update', $career) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.careers._form')
        </form>
    </div>
@endsection
