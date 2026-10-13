<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Emak Natural Clinic Admin</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body { background: var(--ek-off-white); }
        .ek-admin-sidebar {
            width: 260px; position: fixed; top: 0; bottom: 0; left: 0;
            background: var(--ek-gray-900); color: rgba(255,255,255,.85);
            overflow-y: auto; z-index: 1030;
            transition: transform .25s ease;
        }
        .ek-admin-sidebar .brand { padding: 1.4rem 1.25rem; font-family: var(--ek-font-heading); font-weight: 700; color: #fff; font-size: 1.2rem; border-bottom: 1px solid rgba(255,255,255,.08); }
        .ek-admin-sidebar .brand span { color: #8FE3A9; }
        .ek-admin-sidebar .nav-section { text-transform: uppercase; font-size: .7rem; letter-spacing: 1px; color: rgba(255,255,255,.4); padding: 1rem 1.25rem .4rem; }
        .ek-admin-sidebar a.nav-link { color: rgba(255,255,255,.8); padding: .6rem 1.25rem; display:flex; align-items:center; gap:.65rem; border-left: 3px solid transparent; }
        .ek-admin-sidebar a.nav-link:hover { background: rgba(255,255,255,.06); color:#fff; }
        .ek-admin-sidebar a.nav-link.active { background: rgba(143,227,169,.16); border-left-color: #8FE3A9; color:#fff; font-weight:600; }
        .ek-admin-content { margin-left: 260px; min-height: 100vh; }
        .ek-admin-topbar { background:#fff; box-shadow: var(--ek-shadow); padding: .9rem 1.5rem; display:flex; justify-content:space-between; align-items:center; }
        .ek-admin-body { padding: 1.75rem; }
        @media (max-width: 991px) {
            .ek-admin-sidebar { transform: translateX(-100%); }
            .ek-admin-sidebar.show { transform: translateX(0); }
            .ek-admin-content { margin-left: 0; }
        }
        .ek-stat-card { border-radius: var(--ek-radius); box-shadow: var(--ek-shadow); background:#fff; padding: 1.5rem; border-left: 4px solid var(--ek-forest); }
        .table thead th { background: var(--ek-forest-light); color: var(--ek-forest-dark); font-weight:600; border:none; }
        .badge-pending { background:#FFE8B3; color:#8A5B00; }
        .badge-confirmed { background:#D2F3E1; color:#1E7A45; }
        .badge-rescheduled { background:#D9E8FC; color:var(--ek-forest); }
        .badge-cancelled, .badge-rejected { background:#FDE8EC; color:#B3122B; }
    </style>
    @stack('styles')
</head>
<body>

    <div class="ek-admin-sidebar" id="ppSidebar">
        <div class="brand"><i class="bi bi-flower2"></i> Emak<span>Admin</span></div>

        <div class="nav-section">Menu</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('admin.appointments.index') }}" class="nav-link {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
            <i class="bi bi-calendar2-check"></i> Appointments
        </a>
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Contact Messages
        </a>

        @if (auth()->user()?->isAdmin())
            <div class="nav-section">Content</div>
            <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Specialists
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard2-pulse"></i> Services
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Gallery
            </a>
            <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> News
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <i class="bi bi-question-circle"></i> FAQs
            </a>
            <a href="{{ route('admin.careers.index') }}" class="nav-link {{ request()->routeIs('admin.careers.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i> Careers
            </a>

            <div class="nav-section">Administration</div>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Users
            </a>
            <a href="{{ route('admin.logs.index') }}" class="nav-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Activity Logs
            </a>
        @endif

        <div class="nav-section">Account</div>
        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Settings
        </a>
        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> View Website
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="mb-3">
            @csrf
            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <div class="ek-admin-content">
        <div class="ek-admin-topbar">
            <button class="btn d-lg-none" onclick="document.getElementById('ppSidebar').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-person-circle fs-5"></i>
                <span>{{ auth()->user()?->name }}</span>
                <span class="badge bg-secondary text-capitalize">{{ auth()->user()?->role }}</span>
            </div>
        </div>

        <div class="ek-admin-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show">{{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
