@extends('admin.layouts.admin')

@section('title', 'Add News')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Add News / Health Tip</h5>
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.news._form')
        </form>
    </div>
@endsection
