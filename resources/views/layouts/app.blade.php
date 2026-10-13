<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Emak Natural Clinic') | {{ __('messages.hero_title') }}</title>
    <meta name="description" content="{{ __('messages.hero_subtitle') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Design System -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    {{-- Top utility bar --}}
    <div class="ek-topbar">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex gap-3">
                <a href="tel:{{ $hospitalSettings['phone'] }}"><i class="bi bi-telephone-fill"></i> {{ $hospitalSettings['phone'] }}</a>
                <a href="mailto:{{ $hospitalSettings['email'] }}" class="d-none d-md-inline"><i class="bi bi-envelope-fill"></i> {{ $hospitalSettings['email'] }}</a>
            </div>
            <a href="tel:{{ $hospitalSettings['emergency'] }}" class="ek-emergency">
                <i class="bi bi-heart-pulse-fill"></i> {{ __('messages.emergency_label') }}
            </a>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg ek-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
      <img
        src="{{ asset('images/log1.jpg') }}"
        alt="Emaki Natural Remedies Clinic"
        class="emak-logo"
      >
      </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ppNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="ppNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">{{ __('messages.nav_about') }}</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">{{ __('messages.nav_services') }}</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}" href="{{ route('doctors.index') }}">{{ __('messages.nav_doctors') }}</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">More</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('gallery.index') }}">{{ __('messages.nav_gallery') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('news.index') }}">{{ __('messages.nav_news') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('faq.index') }}">{{ __('messages.nav_faq') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('careers.index') }}">{{ __('messages.nav_careers') }}</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" href="{{ route('contact.index') }}">{{ __('messages.nav_contact') }}</a></li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    {{-- Language switcher / settings --}}
                    <div class="dropdown ek-lang-switch">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-translate"></i>
                            @switch(app()->getLocale())
                                @case('sw') Kiswahili @break
                                @case('fr') Français @break
                                @case('zh') 中文 @break
                                @default English
                            @endswitch
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'sw') }}">🇹🇿 Kiswahili</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">🇬🇧 English</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">🇫🇷 Français</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'zh') }}">🇨🇳 中文</a></li>
                        </ul>
                    </div>
                    <a href="{{ route('appointment.create') }}" class="btn btn-ek-primary">{{ __('messages.nav_book_appointment') }}</a>
                </div>
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="ek-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5><i class="bi bi-flower2"></i> Emak Natural Clinic</h5>
                    <p>{{ __('messages.footer_about_text') }}</p>
                    <div class="ek-social mt-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://wa.me/{{ $hospitalSettings['whatsapp'] }}"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h5>{{ __('messages.footer_quick_links') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('about') }}">{{ __('messages.nav_about') }}</a></li>
                        <li class="mb-2"><a href="{{ route('services.index') }}">{{ __('messages.nav_services') }}</a></li>
                        <li class="mb-2"><a href="{{ route('doctors.index') }}">{{ __('messages.nav_doctors') }}</a></li>
                        <li class="mb-2"><a href="{{ route('contact.index') }}">{{ __('messages.nav_contact') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5>{{ __('messages.footer_our_services') }}</h5>
                    <ul class="list-unstyled">
                        @foreach (($footerServices ?? []) as $fs)
                            <li class="mb-2"><i class="bi bi-check2 text-white-50"></i> {{ $fs->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5>{{ __('messages.footer_contact_info') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill"></i> {{ $hospitalSettings['address'] }}</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill"></i> {{ $hospitalSettings['phone'] }}</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill"></i> {{ $hospitalSettings['email'] }}</li>
                    </ul>
                </div>
            </div>
            <div class="ek-footer-bottom text-center">
                <p class="small mb-2" style="opacity:.75;">{{ __('messages.disclaimer') }}</p>
                &copy; {{ date('Y') }} Emak Natural Clinic. {{ __('messages.footer_rights') }}
            </div>
        </div>
    </footer>

    {{-- Floating WhatsApp button --}}
    <a href="https://wa.me/{{ $hospitalSettings['whatsapp'] }}" class="ek-whatsapp-float" target="_blank" rel="noopener">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
