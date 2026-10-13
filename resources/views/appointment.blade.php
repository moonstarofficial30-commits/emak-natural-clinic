@extends('layouts.app')

@section('title', __('messages.nav_book_appointment'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.hero_cta_appointment') }}</div>
            <h1 class="mt-2">{{ __('messages.nav_book_appointment') }}</h1>
            <p class="lead">{{ __('messages.appointment_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="ek-form-card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('appointment.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.full_name') }}</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.email') }}</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('messages.gender') }}</label>
                                    <select name="gender" class="form-select" required>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>{{ __('messages.male') }}</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>{{ __('messages.female') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">{{ __('messages.age') }}</label>
                                    <input type="number" name="age" min="0" max="120" class="form-control" value="{{ old('age') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.department') }}</label>
                                    <select name="department_id" class="form-select">
                                        <option value="">—</option>
                                        @foreach ($departments as $dept)
                                            <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.nav_doctors') }}</label>
                                    <select name="doctor_id" class="form-select">
                                        <option value="">—</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }} — {{ $doctor->specialization }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.appointment_date') }}</label>
                                    <input type="date" name="appointment_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.appointment_time') }}</label>
                                    <input type="time" name="appointment_time" class="form-control" value="{{ old('appointment_time') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ __('messages.message') }}</label>
                                    <textarea name="message" rows="4" class="form-control">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-ek-primary w-100 w-md-auto">
                                        <i class="bi bi-calendar2-check"></i> {{ __('messages.hero_cta_appointment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
