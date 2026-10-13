@extends('layouts.app')

@section('title', __('messages.nav_careers'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.nav_careers') }}</div>
            <h1 class="mt-2">{{ __('messages.careers_title') }}</h1>
            <p class="lead">{{ __('messages.careers_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-4">
                @forelse ($careers as $job)
                    <div class="col-lg-6">
                        <div class="ek-card p-4">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                <h5 class="mb-1">{{ $job->title }}</h5>
                                <span class="badge" style="background: var(--ek-forest-light); color: var(--ek-forest);">
                                    {{ __('messages.employment_type') }}: {{ ucfirst(str_replace('_',' ',$job->employment_type)) }}
                                </span>
                            </div>
                            @if ($job->department)
                                <p class="text-muted small mb-2">{{ $job->department }}</p>
                            @endif
                            <p class="text-muted">{{ $job->description }}</p>
                            @if ($job->requirements)
                                <p class="small"><strong>{{ __('messages.requirements') }}:</strong> {{ $job->requirements }}</p>
                            @endif
                            @if ($job->deadline)
                                <p class="small text-danger mb-3">
                                    <i class="bi bi-clock"></i> {{ __('messages.deadline') }}: {{ $job->deadline->format('d M Y') }}
                                </p>
                            @endif
                            <a href="{{ route('contact.index') }}" class="btn btn-ek-primary btn-sm">{{ __('messages.apply_now') }}</a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">{{ __('messages.no_open_positions') }}</p>
                @endforelse
            </div>
        </div>
    </section>

@endsection
