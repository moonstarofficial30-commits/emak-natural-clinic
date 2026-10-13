@extends('layouts.app')

@section('title', __('messages.nav_news'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.nav_news') }}</div>
            <h1 class="mt-2">{{ __('messages.news_title') }}</h1>
            <p class="lead">{{ __('messages.news_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-4">
                @forelse ($news as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="ek-card">
                            <img src="{{ $item->cover_url }}"
                                 class="w-100 rounded-top-4" style="height:180px;object-fit:cover;" alt="{{ $item->title }}">
                            <div class="p-4">
                                <div class="ek-specialty mb-2 text-capitalize">{{ str_replace('_', ' ', $item->category) }}</div>
                                <h5>{{ $item->title }}</h5>
                                <p class="text-muted small">{{ $item->excerpt }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">{{ __('messages.published_on') }} {{ $item->published_at?->format('d M Y') }}</small>
                                    <a href="{{ route('news.show', $item) }}" class="fw-semibold">{{ __('messages.read_more') }} <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">—</p>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $news->links() }}
            </div>
        </div>
    </section>

@endsection
