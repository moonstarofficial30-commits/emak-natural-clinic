@extends('layouts.app')

@section('title', __('messages.nav_services'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.services_eyebrow') }}</div>
            <h1 class="mt-2">{{ __('messages.services_title') }}</h1>
            <p class="lead">{{ __('messages.services_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="ek-card p-4">
                            <div class="ek-icon-wrap"><i class="bi {{ $service->icon }}"></i></div>
                            <h5>{{ $service->name }}</h5>
                            <p class="text-muted">{{ $service->short_desc }}</p>
                            <a href="{{ route('services.show', $service) }}" class="fw-semibold">{{ __('messages.learn_more') }} <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="ek-disclaimer mt-5">
                <i class="bi bi-info-circle-fill"></i> {{ __('messages.disclaimer') }}
            </div>
        </div>
    </section>

@endsection
