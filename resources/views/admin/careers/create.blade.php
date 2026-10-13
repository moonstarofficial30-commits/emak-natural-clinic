@extends('admin.layouts.admin')

@section('title', 'Post Job')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Post a New Job</h5>
        <form action="{{ route('admin.careers.store') }}" method="POST">
            @csrf
            @include('admin.careers._form')
        </form>
    </div>
@endsection
