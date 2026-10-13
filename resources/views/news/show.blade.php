@extends('layouts.app')

@section('title', $news->title)

@section('content')

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="ek-specialty mb-2 text-capitalize">{{ str_replace('_', ' ', $news->category) }}</div>
                    <h1>{{ $news->title }}</h1>
                    <p class="text-muted mb-4">{{ __('messages.published_on') }} {{ $news->published_at?->format('d M Y') }}</p>

                    @if ($news->cover_image)
                        <img src="{{ $news->cover_url }}" class="img-fluid rounded-4 shadow mb-4 w-100" style="max-height:420px;object-fit:cover;" alt="{{ $news->title }}">
                    @endif

                    <div class="ek-section-sub" style="max-width: none;">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <a href="{{ route('news.index') }}" class="btn btn-ek-secondary mt-4">
                        <i class="bi bi-arrow-left"></i> {{ __('messages.back_to_news') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
