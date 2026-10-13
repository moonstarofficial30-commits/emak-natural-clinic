@extends('layouts.app')

@section('title', $doctor->name)

@section('content')

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <img src="{{ $doctor->photo_url }}"
                         class="img-fluid rounded-4 shadow" alt="{{ $doctor->name }}">
                </div>
                <div class="col-lg-8">
                    <h1>{{ $doctor->name }}</h1>
                    <div class="ek-specialty fs-5 mb-3">{{ $doctor->specialization }}</div>

                    <ul class="list-unstyled">
                        @if ($doctor->department)
                            <li class="mb-2"><i class="bi bi-diagram-3 text-primary"></i> <strong>{{ __('messages.department') }}:</strong> {{ $doctor->department->name }}</li>
                        @endif
                        @if ($doctor->experience_years > 0)
                            <li class="mb-2"><i class="bi bi-award text-primary"></i> <strong>{{ __('messages.years_experience') }}:</strong> {{ $doctor->experience_years }}</li>
                        @endif
                        @if ($doctor->working_days)
                            <li class="mb-2"><i class="bi bi-calendar-week text-primary"></i> <strong>{{ __('messages.working_days') }}:</strong> {{ implode(', ', $doctor->working_days) }}</li>
                        @endif
                    </ul>

                    @if ($doctor->bio)
                        <p class="ek-section-sub">{{ $doctor->bio }}</p>
                    @endif

                    <a href="{{ route('appointment.create') }}" class="btn btn-ek-primary mt-2">
                        <i class="bi bi-calendar2-check"></i> {{ __('messages.hero_cta_appointment') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="ek-section ek-section-tint text-center">
        <div class="container">
            <a href="{{ route('doctors.index') }}" class="btn btn-ek-secondary">
                <i class="bi bi-arrow-left"></i> {{ __('messages.view_all_doctors') }}
            </a>
        </div>
    </section>

@endsection
