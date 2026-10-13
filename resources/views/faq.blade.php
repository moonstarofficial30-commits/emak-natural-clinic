@extends('layouts.app')

@section('title', __('messages.nav_faq'))

@section('content')

    <section class="ek-hero" style="padding: 3.5rem 0;">
        <div class="container">
            <div class="ek-eyebrow" style="color:#CDEED8;">{{ __('messages.nav_faq') }}</div>
            <h1 class="mt-2">{{ __('messages.faq_title') }}</h1>
            <p class="lead">{{ __('messages.faq_sub') }}</p>
        </div>
    </section>

    <section class="ek-section ek-section-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="ppFaqAccordion">
                        @forelse ($faqs as $i => $faq)
                            <div class="accordion-item mb-3 rounded-4 overflow-hidden shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $i === 0 ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                                     data-bs-parent="#ppFaqAccordion">
                                    <div class="accordion-body text-muted">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center">—</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
