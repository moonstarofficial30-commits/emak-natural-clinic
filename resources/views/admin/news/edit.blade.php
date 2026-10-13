@extends('admin.layouts.admin')

@section('title', 'Edit News')

@section('content')
    <div class="bg-white rounded-4 shadow-sm p-4">
        <h5 class="mb-4">Edit News — {{ $news->title }}</h5>
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.news._form')
        </form>
    </div>
@endsection
