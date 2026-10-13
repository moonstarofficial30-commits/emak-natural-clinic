@extends('layouts.app')

@section('title', __('messages.nav_doctors'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.doctors_eyebrow') }}</div>
            <h1 class="mt-2">{{ __('messages.doctors_title') }}</h1>
            <p class="lead">{{ __('messages.doctors_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-4">
                @foreach ($doctors as $doctor)
                    <div class="col-md-6 col-lg-4">
                        <div class="ek-doctor-card">
                            <img src="{{ $doctor->photo_url }}"
                                 class="ek-doctor-photo" alt="{{ $doctor->name }}">
                            <div class="ek-doctor-body">
                                <h5 class="mb-1">{{ $doctor->name }}</h5>
                                <div class="ek-specialty mb-1">{{ $doctor->specialization }}</div>
                                @if ($doctor->department)
                                    <div class="text-muted small mb-2">{{ __('messages.department') }}: {{ $doctor->department->name }}</div>
                                @endif
                                @if ($doctor->experience_years > 0)
                                    <p class="text-muted small mb-3">{{ $doctor->experience_years }} {{ __('messages.years_experience') }}</p>
                                @endif
                                <a href="{{ route('doctors.show', $doctor) }}" class="btn btn-ek-secondary btn-sm w-100">{{ __('messages.view_profile') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
