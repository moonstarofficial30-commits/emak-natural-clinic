@extends('layouts.app')

@section('title', $service->name)

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.services_eyebrow') }}</div>
            <h1 class="mt-2">{{ $service->name }}</h1>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="ek-icon-wrap mb-3" style="width:80px;height:80px;font-size:2rem;">
                        <i class="bi {{ $service->icon }}"></i>
                    </div>
                    <p class="ek-section-sub">{{ $service->description ?? $service->short_desc }}</p>
                    <a href="{{ route('appointment.create') }}" class="btn btn-ek-primary mt-2">
                        <i class="bi bi-calendar2-check"></i> {{ __('messages.hero_cta_appointment') }}
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ $service->image_url }}"
                         class="img-fluid rounded-4 shadow" alt="{{ $service->name }}">
                </div>
            </div>
        </div>
    </section>

    <section class="ek-section ek-section-tint text-center">
        <div class="container">
            <a href="{{ route('services.index') }}" class="btn btn-ek-secondary">
                <i class="bi bi-arrow-left"></i> {{ __('messages.view_all_services') }}
            </a>
        </div>
    </section>

@endsection
