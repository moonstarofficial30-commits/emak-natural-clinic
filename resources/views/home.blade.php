@extends('layouts.app')

@section('title', __('messages.nav_home'))

@section('content')

    {{-- HERO --}}
    <section class="ek-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="ek-badge-emergency mb-3">
                        <i class="bi bi-telephone-fill"></i> {{ __('messages.emergency_label') }}: {{ $hospitalSettings['emergency'] }}
                    </span>
                    <h1 class="mt-3">{{ __('messages.hero_title') }}</h1>
                    <p class="lead">{{ __('messages.hero_subtitle') }}</p>
                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="{{ route('appointment.create') }}" class="btn btn-ek-primary btn-lg">
                            <i class="bi bi-calendar2-check"></i> {{ __('messages.hero_cta_appointment') }}
                        </a>
                        <a href="{{ route('services.index') }}" class="btn btn-ek-outline-white btn-lg">
                            {{ __('messages.hero_cta_services') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- WELCOME --}}
    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="{{ asset('images/leaves.svg') }}"
                         class="img-fluid rounded-4 shadow" alt="Emak Natural Clinic">
                </div>
                <div class="col-lg-6">
                    <div class="ek-eyebrow">{{ __('messages.welcome_eyebrow') }}</div>
                    <h2 class="ek-section-title">{{ __('messages.welcome_title') }}</h2>
                    <p class="ek-section-sub">{{ __('messages.welcome_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="ek-section ek-section-tint">
        <div class="container">
            <div class="text-center mb-5">
                <div class="ek-eyebrow">{{ __('messages.why_title') }}</div>
                <h2 class="ek-section-title">{{ __('messages.why_sub') }}</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-mortarboard-fill"></i></div>
                        <div>
                            <h5 class="mb-1">{{ __('messages.why_1_title') }}</h5>
                            <p class="text-muted mb-0">{{ __('messages.why_1_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-flower1"></i></div>
                        <div>
                            <h5 class="mb-1">{{ __('messages.why_2_title') }}</h5>
                            <p class="text-muted mb-0">{{ __('messages.why_2_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-clipboard2-pulse"></i></div>
                        <div>
                            <h5 class="mb-1">{{ __('messages.why_3_title') }}</h5>
                            <p class="text-muted mb-0">{{ __('messages.why_3_desc') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-calendar2-check"></i></div>
                        <div>
                            <h5 class="mb-1">{{ __('messages.why_4_title') }}</h5>
                            <p class="text-muted mb-0">{{ __('messages.why_4_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- QUICK SERVICES --}}
    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="text-center mb-5">
                <div class="ek-eyebrow">{{ __('messages.services_eyebrow') }}</div>
                <h2 class="ek-section-title">{{ __('messages.quick_services_title') }}</h2>
                <p class="ek-section-sub mx-auto">{{ __('messages.services_sub') }}</p>
            </div>
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
            <div class="text-center mt-5">
                <a href="{{ route('services.index') }}" class="btn btn-ek-secondary">{{ __('messages.view_all_services') }}</a>
            </div>
        </div>
    </section>

    {{-- DOCTORS --}}
    <section class="ek-section ek-section-tint">
        <div class="container">
            <div class="text-center mb-5">
                <div class="ek-eyebrow">{{ __('messages.doctors_eyebrow') }}</div>
                <h2 class="ek-section-title">{{ __('messages.doctors_title') }}</h2>
                <p class="ek-section-sub mx-auto">{{ __('messages.doctors_sub') }}</p>
            </div>
            <div class="row g-4">
                @foreach ($doctors as $doctor)
                    <div class="col-md-6 col-lg-4">
                        <div class="ek-doctor-card">
                            <img src="{{ $doctor->photo_url }}"
                                 class="ek-doctor-photo" alt="{{ $doctor->name }}">
                            <div class="ek-doctor-body">
                                <h5 class="mb-1">{{ $doctor->name }}</h5>
                                <div class="ek-specialty mb-2">{{ $doctor->specialization }}</div>
                                @if ($doctor->experience_years > 0)
                                    <p class="text-muted small mb-3">{{ $doctor->experience_years }} {{ __('messages.years_experience') }}</p>
                                @endif
                                <a href="{{ route('doctors.show', $doctor) }}" class="btn btn-ek-secondary btn-sm w-100">{{ __('messages.view_profile') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('doctors.index') }}" class="btn btn-ek-secondary">{{ __('messages.view_all_doctors') }}</a>
            </div>
        </div>
    </section>

    {{-- EMERGENCY BANNER --}}
    <section class="ek-section ek-section-white pt-0">
        <div class="container">
            <div class="p-5 rounded-4 text-white d-flex flex-wrap align-items-center justify-content-between gap-3"
                 style="background: linear-gradient(120deg, var(--ek-leaf-dark), var(--ek-leaf));">
                <div>
                    <h3 class="text-white mb-1">{{ __('messages.emergency_banner_title') }}</h3>
                    <p class="mb-0" style="opacity:.9;">{{ __('messages.emergency_banner_text') }}</p>
                </div>
                <a href="tel:{{ $hospitalSettings['emergency'] }}" class="btn btn-ek-outline-white btn-lg">
                    <i class="bi bi-telephone-fill"></i> {{ __('messages.call_now') }}
                </a>
            </div>
        </div>
    </section>

@endsection
