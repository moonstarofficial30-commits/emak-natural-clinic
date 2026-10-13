@extends('layouts.app')

@section('title', __('messages.nav_about'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.about_eyebrow') }}</div>
            <h1 class="mt-2">{{ __('messages.about_title') }}</h1>
        </div>
    </section>

    {{-- HISTORY --}}
    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="ek-eyebrow">{{ __('messages.about_eyebrow') }}</div>
                    <h2 class="ek-section-title">{{ __('messages.history_title') }}</h2>
                    <p class="ek-section-sub">{{ __('messages.history_text') }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/leaves.svg') }}"
                         class="img-fluid rounded-4 shadow" alt="History">
                </div>
            </div>
        </div>
    </section>

    {{-- VISION / MISSION --}}
    <section class="ek-section ek-section-tint">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="ek-card p-4">
                        <div class="ek-icon-wrap"><i class="bi bi-binoculars-fill"></i></div>
                        <h4>{{ __('messages.vision_title') }}</h4>
                        <p class="text-muted mb-0">{{ __('messages.vision_text') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ek-card p-4">
                        <div class="ek-icon-wrap"><i class="bi bi-bullseye"></i></div>
                        <h4>{{ __('messages.mission_title') }}</h4>
                        <p class="text-muted mb-0">{{ __('messages.mission_text') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CORE VALUES --}}
    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="ek-section-title">{{ __('messages.values_title') }}</h2>
            </div>
            <div class="row g-4 text-center">
                <div class="col-6 col-md-3">
                    <div class="ek-card p-4">
                        <div class="ek-icon-wrap mx-auto"><i class="bi bi-shield-check"></i></div>
                        <h6 class="mt-2">{{ __('messages.value_integrity') }}</h6>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="ek-card p-4">
                        <div class="ek-icon-wrap mx-auto"><i class="bi bi-heart-fill"></i></div>
                        <h6 class="mt-2">{{ __('messages.value_compassion') }}</h6>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="ek-card p-4">
                        <div class="ek-icon-wrap mx-auto"><i class="bi bi-star-fill"></i></div>
                        <h6 class="mt-2">{{ __('messages.value_excellence') }}</h6>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="ek-card p-4">
                        <div class="ek-icon-wrap mx-auto"><i class="bi bi-people-fill"></i></div>
                        <h6 class="mt-2">{{ __('messages.value_teamwork') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
