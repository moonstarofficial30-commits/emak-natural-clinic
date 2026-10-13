@extends('layouts.app')

@section('title', __('messages.nav_contact'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.contact_eyebrow') }}</div>
            <h1 class="mt-2">{{ __('messages.contact_title') }}</h1>
            <p class="lead">{{ __('messages.contact_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row g-5">
                {{-- Contact form --}}
                <div class="col-lg-7">
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

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.full_name') }}</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.email') }}</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ __('messages.subject') }}</label>
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">{{ __('messages.message') }}</label>
                                    <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-ek-primary w-100 w-md-auto">
                                        <i class="bi bi-send-fill"></i> {{ __('messages.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Contact info --}}
                <div class="col-lg-5">
                    <h4 class="mb-4">{{ __('messages.contact_info_title') }}</h4>
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h6 class="mb-1">{{ __('messages.address') }}</h6>
                            <p class="text-muted mb-0">{{ $hospitalSettings['address'] }}</p>
                        </div>
                    </div>
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h6 class="mb-1">{{ __('messages.phone') }}</h6>
                            <p class="text-muted mb-0">{{ $hospitalSettings['phone'] }}</p>
                        </div>
                    </div>
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <h6 class="mb-1">{{ __('messages.email') }}</h6>
                            <p class="text-muted mb-0">{{ $hospitalSettings['email'] }}</p>
                        </div>
                    </div>
                    <div class="ek-why-item">
                        <div class="ek-why-icon"><i class="bi bi-whatsapp"></i></div>
                        <div>
                            <h6 class="mb-1">{{ __('messages.whatsapp') }}</h6>
                            <a href="https://wa.me/{{ $hospitalSettings['whatsapp'] }}" target="_blank">{{ $hospitalSettings['whatsapp'] }}</a>
                        </div>
                    </div>

                    {{-- Google Map --}}
                    <div class="mt-4 rounded-4 overflow-hidden shadow" style="height: 260px;">
                        @if ($hospitalSettings['map_embed_url'])
                            <iframe src="{{ $hospitalSettings['map_embed_url'] }}" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 bg-light text-muted">
                                <i class="bi bi-map me-2"></i> {{ __('messages.find_us') }} — set HOSPITAL_MAP_EMBED_URL in .env
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
