@extends('layouts.app')

@section('title', __('messages.nav_gallery'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.nav_gallery') }}</div>
            <h1 class="mt-2">{{ __('messages.gallery_title') }}</h1>
            <p class="lead">{{ __('messages.gallery_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            @forelse ($images as $category => $items)
                <h4 class="text-capitalize mb-3">{{ str_replace('_', ' ', $category) }}</h4>
                <div class="row g-3 mb-5">
                    @foreach ($items as $item)
                        <div class="col-6 col-md-4 col-lg-3">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                 class="img-fluid rounded-4 shadow-sm w-100" style="height:200px;object-fit:cover;">
                        </div>
                    @endforeach
                </div>
            @empty
                <p class="text-muted text-center">—</p>
            @endforelse
        </div>
    </section>

@endsection
